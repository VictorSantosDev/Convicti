<?php

declare(strict_types=1);

namespace App\Domain\PointOfSale\Factories\Factory;

use App\Domain\PointOfSale\Entity\PointOfSale;
use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;

class PointOfSaleFactory extends PointOfSaleAbstract
{
    public function getPointOfSale(
        ?int $id,
        ?int $boardId,
        string $name,
        string $latitude,
        string $longitude,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ): PointOfSale {
        return new PointOfSale(
            new Id($id),
            new Id($boardId),
            $name,
            $latitude,
            $longitude,
            new CreatedAt($createdAt),
            new UpdatedAt($updatedAt)
        );
    }
}
