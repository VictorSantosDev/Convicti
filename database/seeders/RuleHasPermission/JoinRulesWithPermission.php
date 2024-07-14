<?php

namespace Database\Seeders\RuleHasPermission;

use App\Enum\Rules\TypeRule;
use App\Models\Permissions;
use App\Models\RuleHasPermission;
use App\Models\Rules;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Prompts\Progress;

use function Laravel\Prompts\progress;

class JoinRulesWithPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collectionPermissionsAndRule = $this->collectionPermissionsBelongsTheRule();

        /** @var Progress $progress */
        $progress = progress(label: 'Insert Point Of Sales', steps: count($collectionPermissionsAndRule));

        $progress->start();
        foreach ($collectionPermissionsAndRule as $permissionAndRule) {
            $permissionModel = Permissions::create([
                'type' => $permissionAndRule['permission_type'],
                'name' => $permissionAndRule['permission_name'],
                'description' => $permissionAndRule['permission_description'],
            ]);

            $rules = Rules::select(['rules.id'])
                ->whereIn('type', $permissionAndRule['belongs_to_the_rule'])
                ->get()
                ->toArray();

            foreach ($rules as $rule) {
                RuleHasPermission::create([
                    'rule_id' => $rule['id'],
                    'permission_id' => $permissionModel->id,
                ]);
            }
            $progress->advance();
        }
        $progress->finish();
    }

    private function collectionPermissionsBelongsTheRule(): array
    {
        return [
            [
                'permission_type' => 'create_sale',
                'permission_name' => 'Criar venda',
                'permission_description' => 'Essa permissão possibilita o usuário a criar venda.',
                'belongs_to_the_rule' => [
                    TypeRule::SELLER->value
                ],
            ],
            [
                'permission_type' => 'show_sale',
                'permission_name' => 'Mostrar venda',
                'permission_description' => 'Essa permissão possibilita o usuário ver a venda.',
                'belongs_to_the_rule' => [
                    TypeRule::SELLER->value,
                    TypeRule::MANAGE->value,
                    TypeRule::BOARD->value,
                    TypeRule::GENERAL_BOARD->value,
                ],
            ],
            [
                'permission_type' => 'list_sale',
                'permission_name' => 'Listar vendas',
                'permission_description' => 'Essa permissão possibilita o usuário a listar as venda.',
                'belongs_to_the_rule' => [
                    TypeRule::SELLER->value,
                    TypeRule::MANAGE->value,
                    TypeRule::BOARD->value,
                    TypeRule::GENERAL_BOARD->value,
                ],
            ],
            [
                'permission_type' => 'list_user',
                'permission_name' => 'Listar usuários',
                'permission_description' => 'Essa permissão possibilita o usuário a listar outros usuário com rules "SELLER" ou "MANAGE".',
                'belongs_to_the_rule' => [
                    TypeRule::SELLER->value,
                    TypeRule::MANAGE->value,
                    TypeRule::BOARD->value,
                    TypeRule::GENERAL_BOARD->value,
                ],
            ],
            [
                'permission_type' => 'list_point_of_sale',
                'permission_name' => 'Listar pontos de vendas (unidades)',
                'permission_description' => 'Essa permissão possibilita o usuário a listar pontos de vendas (unidades).',
                'belongs_to_the_rule' => [
                    TypeRule::BOARD->value,
                    TypeRule::GENERAL_BOARD->value,
                ],
            ],
            [
                'permission_type' => 'list_board',
                'permission_name' => 'Listar diretorias',
                'permission_description' => 'Essa permissão possibilita o usuário a listar as diretorias.',
                'belongs_to_the_rule' => [
                    TypeRule::GENERAL_BOARD->value,
                ],
            ],
        ];
    }
}
