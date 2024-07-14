<?php

declare(strict_types=1);

namespace App\Domain\PointOfSale\Services;

use App\Domain\PointOfSale\Entity\PointOfSale;
use App\Domain\PointOfSale\Infrastructure\Repository\PointOfSaleRepositoryInterface;
use App\ValuesObjects\Id;

class PointOfSaleService
{
    public function __construct(
        private PointOfSaleRepositoryInterface $pointOfSaleRepository
    ) {}

    /** @return PointOfSale[] */
    public function getAllPointOfSales(): array
    {
        return $this->pointOfSaleRepository->getAllPointOfSales();
    }

    public function findById(Id $id): PointOfSale
    {
        return $this->pointOfSaleRepository->findById($id);
    }

    public function findByIdTryFrom(Id $id): ?PointOfSale
    {
        return $this->pointOfSaleRepository->findByIdTryFrom($id);
    }
}
