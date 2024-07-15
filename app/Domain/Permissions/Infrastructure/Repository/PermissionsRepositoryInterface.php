<?php

declare(strict_types=1);

namespace App\Domain\Permissions\Infrastructure\Repository;

use App\Domain\Permissions\Entity\Permission;
use App\ValuesObjects\Id;

interface PermissionsRepositoryInterface
{
    public function findPermissionByUser(string $typePermission, Id $userId): ?Permission;
}
