<?php

namespace App\Domain\Rules\Factories\Factory;

use App\Domain\Rules\Entity\Rule;

abstract class RuleAbstract
{
    abstract public function getRule(
        ?int $id,
        string $type,
        ?string $createdAt,
        ?string $updatedAt
    ): Rule;
}
