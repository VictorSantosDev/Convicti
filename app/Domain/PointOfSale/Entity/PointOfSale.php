<?php

declare(strict_types=1);

namespace App\Domain\PointOfSale\Entity;

use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;
use JsonSerializable;

class PointOfSale implements JsonSerializable
{
    public function __construct(
        private Id $id,
        private Id $boardId,
        private string $name,
        private string $latitude,
        private string $longitude,
        private CreatedAt $createdAt,
        private UpdatedAt $updatedAt
    ) {}

    public function getId(): Id
    {
        return $this->id;
    }

    public function getBoardId(): Id
    {
        return $this->boardId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
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
            'boardId' => $this->getBoardId(),
            'name' => $this->getName(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'createdAt' => $this->getCreatedAt()->toDataBase(),
            'updatedAt' => $this->getUpdatedAt()->toDataBase(),
        ];
    }
}
