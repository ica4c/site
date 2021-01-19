<?php

namespace App\Resources\WeatherHistory;

use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;

class RPCResponseParser
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \App\Resources\WeatherHistory\RPCResponse
     * @throws \JsonException
     */
    public function parseResponse(ResponseInterface $response): RPCResponse
    {
        $data = json_decode(
            $response->getBody()->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        return new RPCResponse(
            Arr::get($data, 'id'),
            Arr::get($data, 'jsonrpc'),
            Arr::get($data, 'result'),
            Arr::get($data, 'error', []),
        );
    }
}
