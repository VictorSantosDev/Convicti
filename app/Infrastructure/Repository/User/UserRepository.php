<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\User;

use App\Domain\User\Entity\User;
use App\Domain\User\Factories\Factory\UserFactory;
use App\Domain\User\Infrastructure\Repository\UserRepositoryInterface;
use App\Models\User as Model;
use App\ValuesObjects\Id;
use Exception;

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
