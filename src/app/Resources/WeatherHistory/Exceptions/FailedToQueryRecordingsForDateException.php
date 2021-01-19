<?php

namespace App\Resources\WeatherHistory\Exceptions;

use App\Resources\WeatherHistory\RPCResponse;
use DateTimeInterface;
use Exception;

class FailedToQueryRecordingsForDateException extends Exception
{
    protected DateTimeInterface $date;
    /** @var \App\Resources\WeatherHistory\RPCResponse|null */
    private ?RPCResponse $response;

    /**
     * FailedToQueryRecordingsForDateException constructor.
     *
     * @param \DateTimeInterface                             $date
     * @param \App\Resources\WeatherHistory\RPCResponse|null $response
     */
    public function __construct(DateTimeInterface $date, ?RPCResponse $response = null)
    {
        parent::__construct(sprintf('Failed to query data for %s', $date->format('Y-m-d')), 402);
        $this->date = $date;
        $this->response = $response;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @return \App\Resources\WeatherHistory\RPCResponse|null
     */
    public function getResponse(): ?RPCResponse
    {
        return $this->response;
    }
}
