<?php

declare(strict_types=1);

namespace App\Domain\Board\Infrastructure\Repository;

use App\Domain\Board\Entity\Board;
use App\ValuesObjects\Id;

interface BoardRepositoryInterface
{
    public function findAllWithFilter(?string $name, int $limit): array;
    public function findByIdUserTryFrom(Id $id): ?Board;
}
