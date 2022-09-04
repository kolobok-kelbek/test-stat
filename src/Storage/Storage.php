<?php

declare(strict_types=1);

namespace App\Storage;

interface Storage
{
    public function hIncrBy(string $key, string $hashKey, $value): void;
    public function hGetAll(string $key): array;
}
