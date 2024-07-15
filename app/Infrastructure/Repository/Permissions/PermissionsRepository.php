<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\Permissions;

use App\Domain\Permissions\Entity\Permission;
use App\Domain\Permissions\Factories\Factory\PermissionFactory;
use App\Domain\Permissions\Infrastructure\Repository\PermissionsRepositoryInterface;
use App\ValuesObjects\Id;
use Illuminate\Support\Facades\DB;

class PermissionsRepository implements PermissionsRepositoryInterface
{
    public function findPermissionByUser(
        string $typePermission,
        Id $userId
    ): ?Permission {
        $row = DB::table('rule_has_permission as rhp')
        ->select(['p.*'])
            ->join('permissions as p', 'rhp.permission_id', '=', 'p.id')
            ->join('rules as r', 'rhp.rule_id', '=', 'r.id')
            ->join('users as u', 'r.id', '=', 'u.rule_id')
        ->where('u.id', $userId->get())
        ->where('p.type', $typePermission)->first();
        
        if (!$row) {
            return null;
        }

        $permissionFactory = new PermissionFactory;
        return $permissionFactory->getPermission(
            id: $row->id,
            type: $row->type,
            name: $row->name,
            description: $row->description,
            createdAt: $row->created_at,
            updatedAt: $row->updated_at
        );
    }
}
