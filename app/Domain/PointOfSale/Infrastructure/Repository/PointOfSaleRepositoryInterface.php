<?php

declare(strict_types=1);

namespace App\Domain\PointOfSale\Infrastructure\Repository;

use App\Domain\PointOfSale\Entity\PointOfSale;

interface PointOfSaleRepositoryInterface
{
    /** @return PointOfSale[] */
    public function getAllPointOfSales(): array;
}
