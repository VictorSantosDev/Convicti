<?php

namespace App\Domain\Rules\Infrastructure\Repository;

use App\ValuesObjects\Id;

interface RulesRepositoryInterface
{
    public function findRuleWithPermissions(Id $id): array;
}
