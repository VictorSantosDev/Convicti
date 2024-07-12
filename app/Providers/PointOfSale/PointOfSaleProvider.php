<?php

namespace App\Providers\PointOfSale;

use App\Domain\PointOfSale\Infrastructure\Repository\PointOfSaleRepositoryInterface;
use App\Infrastructure\Repository\PointOfSale\PointOfSaleRepository;
use Illuminate\Support\ServiceProvider;

class PointOfSaleProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PointOfSaleRepositoryInterface::class, PointOfSaleRepository::class);
    }
}
