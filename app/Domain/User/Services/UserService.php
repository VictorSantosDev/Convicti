<?php

declare(strict_types=1);

namespace App\Domain\User\Services;

use App\Domain\User\Entity\User;
use App\Domain\User\Infrastructure\Repository\UserRepositoryInterface;
use App\ValuesObjects\Id;

class UserService
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function list()
    {

    }

    public function findById(Id $id): User
    {
        return $this->findById($id);
    }
}
