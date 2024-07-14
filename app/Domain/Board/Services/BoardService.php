<?php

declare(strict_types=1);

namespace App\Domain\Board\Services;

use App\Domain\Board\Infrastructure\Repository\BoardRepositoryInterface;

class BoardService
{
    public function __construct(private BoardRepositoryInterface $boardRepository) {}

    public function list(?string $name, int $limit): array
    {
        return $this->boardRepository->findAllWithFilter(
            $name,
            $limit
        );
    }
}
