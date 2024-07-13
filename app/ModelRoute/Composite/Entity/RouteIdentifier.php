<?php

declare(strict_types=1);

namespace App\ModelRoute\Composite\Entity;

use App\ValuesObjects\Id;
use JsonSerializable;

class RouteIdentifier implements JsonSerializable
{
    private ?string $distanceByPoint;

    public function __construct(
        private readonly Id $identifier,
        private readonly string $latitude,
        private readonly string $longitude
    ) {}

    public function setDistanceByPoint(?string $value): void
    {
        $this->distanceByPoint = $value;
    }

    public function getIdentifier(): Id
    {
        return $this->identifier;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function getDistanceByPoint(): ?string
    {
        return $this->distanceByPoint;
    }

    public function jsonSerialize(): array
    {
        return [
            'identifier' => $this->getIdentifier(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'distanceByPoint' => $this->distanceByPoint,
        ];
    }
}
