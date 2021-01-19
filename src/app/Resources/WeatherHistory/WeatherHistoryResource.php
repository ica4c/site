<?php

namespace App\Resources\WeatherHistory;

use DateTimeInterface;
use GuzzleHttp\Client;

class WeatherHistoryResource
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

    public function queryForDate(DateTimeInterface $date) {

    }
}
