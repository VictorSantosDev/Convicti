<?php

declare(strict_types=1);

namespace App\Domain\User\Infrastructure\Repository;

use App\Domain\User\Entity\User;
use App\Enum\Rules\TypeRule;
use App\ValuesObjects\Id;

interface UserRepositoryInterface
{
    public function findById(Id $id): User;
    public function findAllWithFilter(
        TypeRule $typeByUserLogged,
        TypeRule $type,
        ?string $name,
        ?string $email,
        ?int $limit
    ): array;
}
