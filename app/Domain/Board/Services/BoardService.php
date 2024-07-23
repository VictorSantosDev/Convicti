<?php

declare(strict_types=1);

namespace App\Domain\Board\Services;

use App\Domain\Board\Entity\Board;
use App\Domain\Board\Infrastructure\Repository\BoardRepositoryInterface;
use App\ValuesObjects\Id;

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

    public function findByIdUserTryFrom(Id $id): ?Board
    {
        return $this->boardRepository->findByIdUserTryFrom($id);
    }
}
