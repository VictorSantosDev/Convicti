<?php

declare(strict_types=1);

namespace App\Domain\Sale\Infrastructure\Repository;

use App\Domain\Sale\Entity\Sale;
use App\Enum\Rules\TypeRule;
use App\ValuesObjects\Id;

interface SaleRepositoryInterface
{
    public function findByIdByUserId(Id $id, Id $userId, TypeRule $type): Sale;
    public function findAllWithFilter(
        string $dateInitial,
        string $dateFinal,
        Id $userId,
        Id $pointOfSaleId,
        Id $boardId,
        TypeRule $type
    ): array;
}
