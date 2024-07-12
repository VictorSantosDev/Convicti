<?php

namespace App\Domain\Sale\Services;

use App\Domain\PointOfSale\Services\PointOfSaleService;
use App\Domain\Route\Services\RouteService;
use App\Domain\Sale\Entity\Sale;

class SaleService
{
    public function __construct(
        private PointOfSaleService $pointOfSaleService,
        private RouteService $routeServices
    ) {}

    public function create(Sale $sale): Sale
    {
        $pointOfSalesCollection = $this->pointOfSaleService->getAllPointOfSales();
        $this->handleNearPointOfSale($pointOfSalesCollection);

        dd($sale);
    }

    /** @param PointOfSale[] $pointOfSalesCollection */
    private function handleNearPointOfSale(array $pointOfSalesCollection)
    {
        $this->routeServices->nearRouteByPointOfSale($pointOfSalesCollection);
    }
}
