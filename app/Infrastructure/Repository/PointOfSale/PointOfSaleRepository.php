<?php

declare(strict_type=1);

namespace App\Infrastructure\Repository\PointOfSale;

use App\Models\PointOfSale as Model;
use App\Domain\PointOfSale\Entity\PointOfSale;
use App\Domain\PointOfSale\Factories\Factory\PointOfSaleFactory;
use App\Domain\PointOfSale\Infrastructure\Repository\PointOfSaleRepositoryInterface;
use App\ValuesObjects\Id;
use Exception;

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

    public function findById(Id $id): PointOfSale
    {
        $row = $this->db::where('id', $id->get())->first();

        if (!$row) {
            throw new Exception('Ponto de venda não encontrado.');
        }

        return $this->pointOfSaleFactory($row);
    }

    public function findByIdTryFrom(Id $id): ?PointOfSale
    {
        $row = $this->db::where('id', $id->get())->first();

        if (!$row) {
            return null;
        }

        return $this->pointOfSaleFactory($row);
    }

    public function findAllWithFilter(?string $name, int $limit): array
    {
        $row = $this->db::where('name', 'LIKE', "$name%");
        return $row->paginate($limit)->toArray();
    }

    private function pointOfSaleFactory(Model $row): PointOfSale 
    {
        $pointOfSaleFactory = new PointOfSaleFactory;
        return $pointOfSaleFactory->getPointOfSale(
            id: $row->id,
            boardId: $row->board_id,
            name: $row->name,
            latitude: $row->latitude,
            longitude: $row->longitude,
            createdAt: $row->created_at?->format('Y-m-d H:i:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:i:s')
        );
    }
}
