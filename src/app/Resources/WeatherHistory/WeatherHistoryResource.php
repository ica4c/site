<?php

namespace App\Resources\WeatherHistory;

use App\Contracts\WeatherResourceContract;
use App\Resources\WeatherHistory\Exceptions\DaysCountCannotOutOfBoundsException;
use App\Resources\WeatherHistory\Exceptions\FailedToQueryRecordingsForDateException;
use App\Resources\WeatherHistory\Exceptions\FailedToQueryRecordingsForLastDaysException;
use DateTimeInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class WeatherHistoryResource implements WeatherResourceContract
{
    /** @var \GuzzleHttp\Client */
    protected $httpClient;

    /**
     * WeatherHistoryResource constructor.
     *
     * @param \GuzzleHttp\Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param \DateTimeInterface $date
     * @return float
     * @throws \App\Resources\WeatherHistory\Exceptions\FailedToQueryRecordingsForDateException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function queryForDate(DateTimeInterface $date): float
    {
        $request = $this->httpClient->post(
            config('services.weather_history.rpc_url'),
            [
                'json' => [
                    'jsonrpc' => '2.0',
                    'id' => 1,
                    'method' => 'weather.getByDate',
                    'params' => [
                        'date' => $date->format('Y-m-d')
                    ]
                ]
            ]
        );

        if ($request->getStatusCode() !== 200) {
            throw new FailedToQueryRecordingsForDateException($date);
        }

        $response = (new RPCResponseParser)
            ->parseResponse($request);

        if($response->hasError()) {
            throw new FailedToQueryRecordingsForDateException($date, $response);
        }

        return (float) $response->getPayload();
    }

    /**
     * @param int $days
     * @return \Illuminate\Support\Collection
     * @throws \App\Resources\WeatherHistory\Exceptions\FailedToQueryRecordingsForLastDaysException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function queryForLastDays(int $days): Collection
    {
        $request = $this->httpClient->post(
            config('services.weather_history.rpc_url'),
            [
                'data' => [
                    'jsonrpc' => '2.0',
                    'id' => 1,
                    'method' => 'weather.getHistory',
                    'params' => [
                        'lastDays' => $days ?? 1
                    ]
                ]
            ]
        );

        if ($request->getStatusCode() !== 200) {
            throw new FailedToQueryRecordingsForLastDaysException($days);
        }

        $response = (new RPCResponseParser)
            ->parseResponse($request);

        if($response->hasError()) {
            throw new FailedToQueryRecordingsForLastDaysException($days, $response);
        }

        return collect($response->getPayload());
    }
}
