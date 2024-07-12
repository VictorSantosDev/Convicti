<?php

namespace App\Domain\Rules\Infrastructure\Repository;

use App\Domain\Rules\Entity\Rule;
use App\ValuesObjects\Id;

interface RulesRepositoryInterface
{
    public function findRuleWithPermissions(Id $id): array;
    public function findByRule(Id $id): Rule;
}
