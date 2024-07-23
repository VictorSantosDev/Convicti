<?php

declare(strict_types=1);

namespace App\Domain\Board\Entity;

use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;
use JsonSerializable;

class Board implements JsonSerializable
{
    public function __construct(
        private Id $id,
        private Id $userId,
        private string $nameBoard,
        private CreatedAt $createdAt,
        private UpdatedAt $updatedAt
    ) {}

    public function getId(): Id
    {
        return $this->id;
    }

    public function getUserId(): Id
    {
        return $this->userId;
    }

    public function getNameBoard(): string
    {
        return $this->nameBoard;
    }

    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): UpdatedAt
    {
        return $this->updatedAt;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId()->get(),
            'userId' => $this->getUserId()->get(),
            'nameBoard' => $this->getNameBoard(),
            'createdAt' => $this->getCreatedAt()->toDateBase(),
            'updatedAt' => $this->getUpdatedAt()->toDateBase(),
        ];
    }
}
