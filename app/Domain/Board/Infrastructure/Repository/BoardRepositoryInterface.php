<?php

declare(strict_types=1);

namespace App\Domain\Board\Infrastructure\Repository;

interface BoardRepositoryInterface
{
    public function findAllWithFilter(?string $name, int $limit): array;
}
