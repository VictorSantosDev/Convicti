<?php

declare(strict_types=1);

namespace App\Domain\Sale\Factories\Factory;

use App\Domain\Sale\Entity\Sale;
use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;

class SaleFactory extends SaleAbstract
{
    public function getSale(
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
    ): Sale {
        return new Sale(
            new Id($id),
            new Id($userId),
            new Id($pointOfSaleId),
            new Id($nearPointOfSaleId),
            $saleValues,
            new CreatedAt($date),
            $hour,
            $kmPointOfSaleMain,
            $kmNearPointOfSale,
            $latitude,
            $longitude,
            $isRoaming,
            new CreatedAt($createdAt),
            new UpdatedAt($updatedAt)
        );
    }
}
