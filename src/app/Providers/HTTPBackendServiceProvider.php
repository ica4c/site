<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class HTTPBackendServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            Client::class,
            static fn() => new Client([
                'timeout' => 30,
                'http_errors' => false
            ])
        );
    }
}
