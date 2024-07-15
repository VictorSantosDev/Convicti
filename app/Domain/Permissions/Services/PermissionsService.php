<?php

declare(strict_types=1);

namespace App\Domain\Permissions\Services;

use App\Domain\Permissions\Entity\Permission;
use App\Domain\Permissions\Infrastructure\Repository\PermissionsRepositoryInterface;
use App\ValuesObjects\Id;

class PermissionsService
{
    public function __construct(private PermissionsRepositoryInterface $permissionsRepository) {}

    public function findPermissionByUser(
        string $typePermission,
        Id $userId
    ): ?Permission {
        return $this->permissionsRepository->findPermissionByUser($typePermission, $userId);
    }
}
