<?php

declare(strict_types=1);

namespace App\Utils\Permission;
use App\Domain\Permissions\Entity\Permission;
use App\Domain\Permissions\Services\PermissionsService;
use App\ValuesObjects\Id;
use Exception;

class CanAccess
{
    static public function check(string $typePermission): bool
    {
        /** @var PermissionsService $permissionsService */
        $permissionsService = resolve(PermissionsService::class);
        $permission = $permissionsService->findPermissionByUser(
            $typePermission,
            Id::set(auth()->user()->id)
        );
        return $permission instanceof Permission;
    }
}
