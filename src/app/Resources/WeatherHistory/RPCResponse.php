<?php

namespace App\Resources\WeatherHistory;

use Illuminate\Support\Arr;

class RPCResponse
{
    protected ?int $id;
    protected ?string $version;
    protected mixed $payload;
    protected array $error;

    /**
     * RPCResponse constructor.
     *
     * @param int|null    $id
     * @param string|null $version
     * @param array       $payload
     * @param array       $error
     */
    public function __construct(?int $id, ?string $version, mixed $payload = null, array $error = [])
    {
        $this->id = $id;
        $this->version = $version;
        $this->payload = $payload;
        $this->error = $error;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return array
     */
    public function getError(): array
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function hasError(): bool {
        return $this->error !== null && !empty($this->error);
    }

    /**
     * @return bool
     */
    public function hasPayload(): bool {
        return $this->payload !== null && !empty($this->payload);
    }
}
