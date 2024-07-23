<?php

declare(strict_types=1);

namespace App\Domain\PointOfSale\Infrastructure\Repository;

use App\Domain\PointOfSale\Entity\PointOfSale;
use App\ValuesObjects\Id;

interface PointOfSaleRepositoryInterface
{
    /** @return PointOfSale[] */
    public function getAllPointOfSales(): array;

    public function findById(Id $id): PointOfSale;

    public function findByIdTryFrom(Id $id): ?PointOfSale;

    public function findAllWithFilter(
        ?string $name,
        int $limit
    ): array;

    public function findAllWithFilterRelatedBoardId(
        Id $boardId,
        ?string $name,
        int $limit
    ): array;
}
