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
}
