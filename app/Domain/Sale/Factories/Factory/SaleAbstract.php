<?php

declare(strict_types=1);

namespace App\Domain\Sale\Factories\Factory;

use App\Domain\Sale\Entity\Sale;

abstract class SaleAbstract
{
    abstract public function getSale(
        ?int $id,
        int $userId,
        ?int $pointOfSaleId,
        ?int $nearPointOfSaleId,
        string $saleValues,
        string $date,
        string $hour,
        ?int $kmPointOfSaleMain,
        ?int $kmNearPointOfSale,
        string $latitude,
        string $longitude,
        ?bool $isRoaming,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ): Sale;
}
