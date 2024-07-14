<?php

namespace App\Providers\Board;

use App\Domain\Board\Infrastructure\Repository\BoardRepositoryInterface;
use App\Infrastructure\Repository\Board\BoardRepository;
use Illuminate\Support\ServiceProvider;

class BoardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BoardRepositoryInterface::class, BoardRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
