<?php

declare(strict_types=1);

namespace App\Domain\Board\Factories\Factory;

use App\Domain\Board\Entity\Board;

abstract class BoardAbstract
{
    abstract public function getBoard(
        int $id,
        int $userId,
        string $nameBoard,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ): Board;
}
