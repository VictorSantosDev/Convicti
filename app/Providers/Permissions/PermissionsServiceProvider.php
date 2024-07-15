<?php

namespace App\Providers\Permissions;

use App\Domain\Permissions\Infrastructure\Repository\PermissionsRepositoryInterface;
use App\Infrastructure\Repository\Permissions\PermissionsRepository;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PermissionsRepositoryInterface::class, PermissionsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
