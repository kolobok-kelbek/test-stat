<?php

declare(strict_types=1);

namespace App\Statistic;

interface Repository
{
    public function update(string $countryCode): void;
    public function getAll(): array;
}
