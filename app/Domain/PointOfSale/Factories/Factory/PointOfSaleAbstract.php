<?php

declare(strict_types=1);

namespace App\Domain\PointOfSale\Factories\Factory;

use App\Domain\PointOfSale\Entity\PointOfSale;

abstract class PointOfSaleAbstract
{
    abstract public function getPointOfSale(
        ?int $id,
        ?int $boardId,
        string $name,
        string $latitude,
        string $longitude,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ): PointOfSale;
}
