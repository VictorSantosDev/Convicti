<?php

declare(strict_types=1);

namespace App\Domain\Sale\Entity;

use App\Utils\DateTime\CreatedAt;
use App\Utils\DateTime\UpdatedAt;
use App\ValuesObjects\Id;
use JsonSerializable;

class Sale implements JsonSerializable
{
    public function __construct(
        private Id $id,
        private Id $userId,
        private Id $pointOfSaleId,
        private Id $nearPointOfSaleId,
        private string $saleValues,
        private CreatedAt $date,
        private string $hour,
        private ?string $kmNearPointOfSale,
        private string $latitude,
        private string $longitude,
        private ?bool $isRoaming,
        private CreatedAt $createdAt,
        private UpdatedAt $updatedAt
    ){}

    public function getId(): Id
    {
        return $this->id;
    }

    public function getUserId(): Id
    {
        return $this->userId;
    }

    public function getPointOfSaleId(): Id
    {
        return $this->pointOfSaleId;
    }

    public function getNearPointOfSaleId(): Id
    {
        return $this->nearPointOfSaleId;
    }

    public function getSaleValues(): string
    {
        return $this->saleValues;
    }

    public function getDate(): CreatedAt
    {
        return $this->date;
    }

    public function getHour(): string
    {
        return $this->hour;
    }

    public function getKmNearPointOfSale(): ?string
    {
        return $this->kmNearPointOfSale;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function getIsRoaming(): ?bool
    {
        return $this->isRoaming;
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
            'userId' => $this->getUserId()->get(),
            'pointOfSaleId' => $this->getPointOfSaleId()->get(),
            'nearPointOfSaleId' => $this->getNearPointOfSaleId()->get(),
            'saleValues' => $this->getSaleValues(),
            'date' => $this->getDate()->toDate(),
            'hour' => $this->getHour(),
            'kmNearPointOfSale' => $this->getKmNearPointOfSale(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'isRoaming' => $this->getIsRoaming(),
            'createdAt' => $this->getCreatedAt()->toDateBase(),
            'updatedAt' => $this->getUpdatedAt()->toDateBase(),
        ];
    }
}
