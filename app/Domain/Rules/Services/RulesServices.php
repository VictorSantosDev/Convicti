<?php

namespace App\Domain\Rules\Services;

use App\Domain\Rules\Entity\Rule;
use App\Domain\Rules\Infrastructure\Repository\RulesRepositoryInterface;
use App\ValuesObjects\Id;

class RulesServices
{
    public function __construct(private RulesRepositoryInterface $rulesRepository){}

    public function findAllRulesWithPermissions(Id $id): array
    {
        return $this->rulesRepository->findRuleWithPermissions($id);
    }

    public function findByRule(Id $id): Rule
    {
        return $this->rulesRepository->findByRule($id);
    }
}
