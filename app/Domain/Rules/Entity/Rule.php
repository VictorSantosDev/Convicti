<?php

namespace App\Domain\Rules\Entity;

use App\Enum\Rules\TypeRule;
use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;
use JsonSerializable;

class Rule implements JsonSerializable
{
    public function __construct(
        private Id $id,
        private TypeRule $type,
        private CreatedAt $created_at,
        private UpdatedAt $updated_at
    ) {}

    public function getId(): Id
    {
        return $this->id;
    }

    public function getType(): TypeRule
    {
        return $this->type;
    }

    public function getCreatedAt(): CreatedAt
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): UpdatedAt
    {
        return $this->updated_at;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId()->get(),
            'type' => $this->getType()->value,
            'created_at' => $this->getCreatedAt()->toDateBase(),
            'updated_at' => $this->getUpdatedAt()->toDateBase()
        ];
    }
}
