<?php

namespace App\Domain\Permissions\Factories\Factory;

use App\Domain\Permissions\Entity\Permission;

abstract class PermissionAbstract
{
    abstract public function getPermission(
        ?int $id,
        string $type,
        string $name,
        string $description,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ): Permission;
}
