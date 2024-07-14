<?php

namespace App\Infrastructure\Repository\Rules;

use App\Domain\Permissions\Factories\Factory\PermissionFactory;
use App\Domain\Rules\Entity\Rule;
use App\Domain\Rules\Factories\Factory\RuleFactory;
use App\Domain\Rules\Infrastructure\Repository\RulesRepositoryInterface;
use App\Models\Rules as RulesModel;
use App\ValuesObjects\Id;
use Exception;
use Illuminate\Support\Facades\DB;

class RulesRepository implements RulesRepositoryInterface
{
    public function __construct(private RulesModel $db) {}

    public function findRuleWithPermissions(Id $id): array
    {
        $rows = DB::table('rules as r')
        ->select([
            'p.*'
        ])
        ->join('rule_has_permission as rhp', 'r.id', '=', 'rhp.rule_id')
        ->join('permissions as p', 'p.id', '=', 'rhp.permission_id')
        ->where('r.id', $id->get())
        ->get();

        $permissionFactory = new PermissionFactory;
        $data = $rows->map(function ($item) use ($permissionFactory) {
            return $permissionFactory->getPermission(
                id: $item->id,
                type: $item->type,
                name: $item->name,
                description: $item->description,
                createdAt: $item->created_at,
                updatedAt: $item->updated_at
            )->getType();
        });

        return $data->toArray();
    }

    public function findByRule(Id $id): Rule
    {
        $row = $this->db::where('id', $id->get())->first();

        if (!$row) {
            throw new Exception('Função não encontrada');
        }

        $ruleFactory = new RuleFactory;
        
        return $ruleFactory->getRule(
            $row->id,
            $row->type,
            $row->created_at?->format('Y-m-d H:i:s'),
            $row->updated_at?->format('Y-m-d H:i:s')
        );
    }
}
