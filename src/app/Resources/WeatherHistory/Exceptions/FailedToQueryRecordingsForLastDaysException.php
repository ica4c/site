<?php

namespace App\Resources\WeatherHistory\Exceptions;

use App\Resources\WeatherHistory\RPCResponse;
use Exception;

class FailedToQueryRecordingsForLastDaysException extends Exception
{
    protected int $days;
    protected ?RPCResponse $response;

    /**
     * FailedToQueryRecordingsForLastDaysException constructor.
     *
     * @param int                                            $days
     * @param \App\Resources\WeatherHistory\RPCResponse|null $response
     */
    public function __construct(int $days, ?RPCResponse $response = null)
    {
        parent::__construct(sprintf("Failed to query data for last %d days", $days), 402);

        $this->days = $days;
        $this->response = $response;
    }

    /**
     * @return int
     */
    public function getDays(): int
    {
        return $this->days;
    }

    /**
     * @return \App\Resources\WeatherHistory\RPCResponse
     */
    public function getResponse(): RPCResponse
    {
        return $this->response;
    }
}
