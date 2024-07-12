<?php

namespace App\Domain\Rules\Factories\Factory;

use App\Domain\Rules\Entity\Rule;
use App\Enum\Rules\TypeRule;
use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;

class RuleFactory extends RuleAbstract
{
    public function getRule(
        ?int $id,
        string $type,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ): Rule {
        return new Rule(
            new Id($id),
            TypeRule::tryFrom($type),
            new CreatedAt($createdAt),
            new UpdatedAt($updatedAt)
        );
    }
}
