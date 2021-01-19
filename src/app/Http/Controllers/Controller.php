<?php

namespace App\Http\Controllers;

use App\Http\Requests\Weather\GetWeatherForDateRequest;
use App\Resources\WeatherHistory\Exceptions\FailedToQueryRecordingsForDateException;
use App\Services\Weather\Exceptions\DaysCountCannotOutOfBoundsException;
use App\Services\Weather\WeatherQueryService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var \App\Services\Weather\WeatherQueryService */
    protected $weatherQuerySvc;

    /**
     * Controller constructor.
     *
     * @param \App\Services\Weather\WeatherQueryService $weatherQuerySvc
     */
    public function __construct(WeatherQueryService $weatherQuerySvc)
    {
        $this->weatherQuerySvc = $weatherQuerySvc;
    }

    public function postGetForDate(GetWeatherForDateRequest $request) {
        $date = Carbon::parse($request->input('date'));

        try {
            $temperature = $this->weatherQuerySvc->queryForDate($date);
            return back()->with('temperature', $temperature);
        } catch (FailedToQueryRecordingsForDateException $exception) {
            if($exception->getResponse() !== null) {
                return back()
                    ->withErrors(
                        __('Failed to request weather for day',
                            [
                                'day' => $date,
                                'reason' => json_encode($exception->getResponse()->getError(), JSON_THROW_ON_ERROR)
                            ]
                        )
                    );
            }

            return back()
                ->withErrors(__('Failed to request weather for day', ['day' => $date]));
        }
    }
}
