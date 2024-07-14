<?php

declare(strict_types=1);

namespace App\Domain\User\Services;

use App\Domain\Rules\Services\RulesServices;
use App\Domain\User\Entity\User;
use App\Domain\User\Infrastructure\Repository\UserRepositoryInterface;
use App\Enum\Rules\TypeRule;
use App\ValuesObjects\Id;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private RulesServices $rulesServices
    ) {}

    public function list(array $filter): array
    {
        $user = auth()->user();
        $rule = $this->rulesServices->findByRule(Id::set($user->rule_id));

        return $this->userRepository->findAllWithFilter(
            typeByUserLogged: $rule->getType(),
            type: TypeRule::tryFrom($filter['type']),
            name: $filter['name'] ?? null,
            email: $filter['email'] ?? null,
            limit: ($filter['limit'] ?? null) !== null ? (int) $filter['limit'] : 10
        );
    }

    public function findById(Id $id): User
    {
        return $this->findById($id);
    }
}
