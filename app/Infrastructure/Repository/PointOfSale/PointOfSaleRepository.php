<?php

declare(strict_type=1);

namespace App\Infrastructure\Repository\PointOfSale;

use App\Models\PointOfSale as Model;
use App\Domain\PointOfSale\Entity\PointOfSale;
use App\Domain\PointOfSale\Factories\Factory\PointOfSaleFactory;
use App\Domain\PointOfSale\Infrastructure\Repository\PointOfSaleRepositoryInterface;

class PointOfSaleRepository implements PointOfSaleRepositoryInterface
{
    public function __construct(private Model $db) {}

    /** @return PointOfSale[] */
    public function getAllPointOfSales(): array
    {
        $rows = $this->db->all();

        $pointOfSaleFactory = new PointOfSaleFactory;
        $pointOfSalesCollection = $rows->map(function ($item) use ($pointOfSaleFactory) {
            return $pointOfSaleFactory->getPointOfSale(
                id: $item->id,
                boardId: $item->board_id,
                name: $item->name,
                latitude: $item->latitude,
                longitude: $item->longitude,
                createdAt: $item->created_at?->format('Y-m-d H:i:s'),
                updatedAt: $item->updated_at?->format('Y-m-d H:i:s')
            );
        });

        return $pointOfSalesCollection->toArray();
    }
}