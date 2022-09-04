<?php

declare(strict_types=1);

namespace App\Storage;

use Redis;

class RedisStorage implements Storage
{
    public function __construct(
        private readonly string $host,
        private readonly int $port,
        private readonly int $connectTimeout,
        private readonly Redis $redisClient = new Redis()
    ) {
    }

    public function hIncrBy(string $key, $hashKey, $value): void
    {
        $this->connect()->hIncrBy($key, $hashKey, $value);
    }

    public function hGetAll(string $key): array
    {
        return $this->connect()->hGetAll($key);
    }

    private function connect(): Redis
    {
        if (!$this->redisClient->isConnected()){
            $this->redisClient->connect(
                host: $this->host,
                port: $this->port,
                timeout: $this->connectTimeout,
            );
        }

        return $this->redisClient;
    }
}
