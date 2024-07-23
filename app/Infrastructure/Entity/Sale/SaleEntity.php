<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity\Sale;

use App\Domain\Sale\Entity\Sale;
use App\Domain\Sale\Factories\Factory\SaleFactory;
use App\Domain\Sale\Infrastructure\Entity\SaleEntityInterface;
use App\Models\Sales as Model;

class SaleEntity implements SaleEntityInterface
{
    public function __construct(private Model $db) {}

    public function create(Sale $sale): Sale
    {
        $row = $this->db->create([
            'user_id' => $sale->getUserId()->get(),
            'point_of_sale_id' => $sale->getPointOfSaleId()->get(),
            'near_point_of_sale_id' => $sale->getNearPointOfSaleId()->get(),
            'sale_values' => $sale->getSaleValues(),
            'km_near_point_of_sale' => $sale->getKmNearPointOfSale(),
            'latitude' => $sale->getLatitude(),
            'longitude' => $sale->getLatitude(),
            'is_roaming' => $sale->getIsRoaming(),
            'created_at' => $sale->getCreatedAt()->toDateBase(),
            'updated_at' => $sale->getCreatedAt()->toDateBase(),
        ]);

        return $this->saleFactory($row);
    }

    private function saleFactory(Model $row): Sale
    {
        $saleFactory = new SaleFactory;
        return $saleFactory->getSale(
            id: $row->id,
            userId: $row->user_id,
            pointOfSaleId: $row->point_of_sale_id,
            nearPointOfSaleId: $row->near_point_of_sale_id,
            saleValues: $row->sale_values,
            kmNearPointOfSale: $row->km_near_point_of_sale,
            latitude: $row->latitude,
            longitude: $row->longitude,
            isRoaming: $row->is_roaming,
            createdAt: $row->created_at?->format('Y-m-d H:i:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:i:s')
        );
    }
}
