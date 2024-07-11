<?php

namespace App\Providers\Rules;

use App\Domain\Rules\Infrastructure\Repository\RulesRepositoryInterface;
use App\Infrastructure\Repository\Rules\RulesRepository;
use Illuminate\Support\ServiceProvider;

class RulesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RulesRepositoryInterface::class, RulesRepository::class);
    }
}
