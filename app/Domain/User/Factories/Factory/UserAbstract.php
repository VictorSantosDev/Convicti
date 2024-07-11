<?php

namespace App\Domain\User\Factories\Factory;

use App\Domain\User\Entity\User;

abstract class UserAbstract
{
    abstract public function getUser(
        int $id,
        int $ruleId,
        ?int $pointOfSaleId,
        string $name,
        string $email,
        ?string $emailVerifiedAt = null,
        string $password,
        ?string $rememberToken,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ): User;
}
