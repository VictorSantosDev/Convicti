<?php

declare(strict_types=1);

namespace App\Domain\User\Infrastructure\Repository;

use App\Domain\User\Entity\User;
use App\ValuesObjects\Id;

interface UserRepositoryInterface
{
    public function findById(Id $id): User;
}
