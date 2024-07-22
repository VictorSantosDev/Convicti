<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\User;

use App\Domain\User\Entity\User;
use App\Domain\User\Factories\Factory\UserFactory;
use App\Domain\User\Infrastructure\Repository\UserRepositoryInterface;
use App\Enum\Rules\TypeRule;
use App\Models\User as Model;
use App\ValuesObjects\Id;
use Exception;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private Model $db) {}

    public function findById(Id $id): User
    {
        $row = $this->db->where('id', $id->get());

        if (!$row) {
            throw new Exception('Usuário não encontrado');
        }

        return $this->userFactory($row);
    }

    public function findAllWithFilter(
        TypeRule $typeByUserLogged,
        TypeRule $type,
        ?string $name,
        ?string $email,
        ?int $limit
    ): array {
        $row = DB::table('users as u')
        ->select([
            'u.id',
            'u.rule_id',
            'u.point_of_sale_id',
            'u.name',
            'u.email',
            'u.email_verified_at',
            'u.remember_token',
            'u.created_at',
            'u.updated_at',
        ])
        ->join('rules as r', 'u.rule_id', '=', 'r.id')
        ->join('point_of_sale as pts', 'u.point_of_sale_id', '=', 'pts.id');

        if (TypeRule::SELLER->value === $typeByUserLogged->value) {
            $row = $row->where('u.id', auth()->user()->id);
        }
        
        if (TypeRule::MANAGE->value === $typeByUserLogged->value) {
            $row = $row->where('pts.id', auth()->user()->point_of_sale_id);
        }

        if (TypeRule::BOARD->value === $typeByUserLogged->value) {
            $row = $row->join('board as b', 'pts.board_id', '=', 'b.id')
            ->where('b.user_id', auth()->user()->id);
        }

        if($name) $row = $row->where('u.name', 'LIKE', "$name%");

        if($email) $row = $row->where('u.name', 'LIKE', "$email%");

        $row = $row->where('r.type', $type->value);

        return $row->paginate($limit)->toArray();
    }

    private function userFactory(Model $row): User
    {
        $userFactory = new UserFactory;
        return $userFactory->getUser(
            id: $row->id,
            ruleId: $row->rule_id,
            pointOfSaleId: $row->point_of_sale_id,
            name: $row->name,
            email: $row->email,
            emailVerifiedAt: $row->email_verified_at,
            password: $row->password,
            rememberToken: $row->remember_token,
            createdAt: $row->created_at,
            updatedAt: $row->updated_at
        );
    }
}
