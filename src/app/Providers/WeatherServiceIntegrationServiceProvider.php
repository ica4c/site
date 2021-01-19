<?php

namespace App\Providers;

use App\Contracts\WeatherResourceContract;
use App\Resources\WeatherHistory\WeatherHistoryResource;
use Illuminate\Support\ServiceProvider;

class WeatherServiceIntegrationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(WeatherResourceContract::class, WeatherHistoryResource::class);
    }
}
