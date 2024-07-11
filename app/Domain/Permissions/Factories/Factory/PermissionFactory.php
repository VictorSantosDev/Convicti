<?php

namespace App\Domain\Permissions\Factories\Factory;

use App\Domain\Permissions\Entity\Permission;
use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;

class PermissionFactory extends PermissionAbstract
{
    public function getPermission(
        ?int $id,
        string $type,
        string $name,
        string $description,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ): Permission {
        return new Permission(
            new Id($id),
            $type,
            $name,
            $description,
            new CreatedAt($createdAt),
            new UpdatedAt($updatedAt)
        );
    }
}
