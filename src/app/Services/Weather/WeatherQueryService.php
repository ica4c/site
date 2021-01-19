<?php

namespace App\Services\Weather;

use App\Contracts\WeatherResourceContract;
use App\Services\Weather\Exceptions\DaysCountCannotOutOfBoundsException;
use DateInterval;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class WeatherQueryService
{
    protected WeatherResourceContract $weatherResource;

    /**
     * WeatherQueryService constructor.
     *
     * @param \App\Contracts\WeatherResourceContract $weatherResource
     */
    public function __construct(WeatherResourceContract $weatherResource)
    {
        $this->weatherResource = $weatherResource;
    }

    /**
     * @param \DateTimeInterface $date
     * @return float
     */
    public function queryForDate(DateTimeInterface $date): float {
        return Cache::remember(
            sprintf('weather:%s', $date->format('Y-m-d')),
            new DateInterval('PT30M'),
            fn() => $this->weatherResource->queryForDate($date)
        );
    }

    /**
     * @param int $days
     * @return \Illuminate\Support\Collection|float[]
     * @throws \App\Services\Weather\Exceptions\DaysCountCannotOutOfBoundsException
     */
    public function queryForLastDays(int $days): Collection {
        if($days < 0 || $days > 30) {
            throw new DaysCountCannotOutOfBoundsException($days, 0, 30);
        }

        return Cache::remember(
            sprintf('weather:%s:%d', now()->format('Y-m-d'), $days),
            new DateInterval('PT30M'),
            fn() => $this->weatherResource->queryForLastDays($days)
        );
    }
}
