<?php

declare(strict_types=1);

namespace App\Domain\User\Factories\Factory;

use App\Domain\User\Entity\User;
use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;

class UserFactory extends UserAbstract
{
    public function getUser(
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
    ): User {
        return new User(
            new Id($id),
            new Id($ruleId),
            new Id($pointOfSaleId),
            $name,
            $email,
            new CreatedAt($emailVerifiedAt),
            $password,
            $rememberToken,
            new CreatedAt($createdAt),
            new UpdatedAt($updatedAt),
        );
    }
}
