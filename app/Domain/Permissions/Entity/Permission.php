<?php

namespace App\Domain\Permissions\Entity;

use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;
use JsonSerializable;

class Permission implements JsonSerializable
{
    public function __construct(
        private Id $id,
        private string $type,
        private string $name,
        private string $description,
        private CreatedAt $createdAt,
        private UpdatedAt $updatedAt
    ) {}

    public function getId(): Id
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): UpdatedAt
    {
        return $this->updatedAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId()->get(),
            'type' => $this->getType(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'created_at' => $this->getCreatedAt()->toDataBase(),
            'updated_at' => $this->getUpdatedAt()->toDataBase(),
        ];
    }
}
