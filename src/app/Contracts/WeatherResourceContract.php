<?php


namespace App\Contracts;

use DateTimeInterface;
use Illuminate\Support\Collection;

interface WeatherResourceContract
{
    /**
     * Use to query temperature for a single day
     * @param \DateTimeInterface $date
     * @return float
     */
    public function queryForDate(DateTimeInterface $date): float;

    /**
     * Use to query temperature for a series of days
     *
     * @param int $days
     * @return Collection|float[]
     */
    public function queryForLastDays(int $days): Collection;
}
