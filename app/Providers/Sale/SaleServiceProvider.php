<?php

namespace App\Providers\Sale;

use App\Domain\Sale\Infrastructure\Entity\SaleEntityInterface;
use App\Domain\Sale\Infrastructure\Repository\SaleRepositoryInterface;
use App\Infrastructure\Entity\Sale\SaleEntity;
use App\Infrastructure\Repository\Sale\SaleRepository;
use Illuminate\Support\ServiceProvider;

class SaleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SaleEntityInterface::class, SaleEntity::class);
        $this->app->bind(SaleRepositoryInterface::class, SaleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
