<?php

declare(strict_types=1);

namespace App\Statistic;

use App\Storage\Storage;

class RepositoryImpl implements Repository
{
    private const COUNTRY_CODE_KEY = 'country_key';
    private const INCREMENT_BY = 1;

    public function __construct(
        private readonly Storage $storage,
    ) {
    }

    public function update(string $countryCode): void
    {
        $this->storage->hIncrBy(static::COUNTRY_CODE_KEY, $countryCode, static::INCREMENT_BY);
    }

    public function getAll(): array
    {
        return $this->storage->hGetAll(static::COUNTRY_CODE_KEY);
    }
}
