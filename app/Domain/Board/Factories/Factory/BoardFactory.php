<?php

declare(strict_types=1);

namespace App\Domain\Board\Factories\Factory;

use App\Domain\Board\Entity\Board;
use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;

class BoardFactory
{
    public function getBoard(
        int $id,
        int $userId,
        string $nameBoard,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ): Board {
        return new Board(
            id: new Id($id),
            userId: new Id($userId),
            nameBoard: $nameBoard,
            createdAt: new CreatedAt($createdAt),
            updatedAt: new UpdatedAt($updatedAt),
        );
    }
}
