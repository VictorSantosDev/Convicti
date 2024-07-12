<?php

declare(strict_types=1);

namespace App\ModelRoute\Composite\Route;

use App\ModelRoute\Composite\Entity\RouteIdentifier;
use App\ModelRoute\Meter\Distance;

class RouteComposed extends RouteComponent
{
    private string $latitudeImmutable;

    private string $longitudeImmutable;

    /** @var RouteComponent[] $routesCollection */
    private array $routesCollection = [];

    public function add(RouteComponent ...$route): self
    {
        $this->routesCollection = array_merge($this->routesCollection, $route);
        return $this;
    }

    public function getNearRoute(): RouteIdentifier
    {
        Distance::calculate(
            latitudeTo: $this->latitudeImmutable,
            longitudeTo: $this->longitudeImmutable,
            latitudeFrom: '-23.6862475',
            longitudeFrom: '-46.5962964',
        );
    
        dd($this->latitudeImmutable, $this->longitudeImmutable);
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitudeImmutable = $latitude;
        return $this;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitudeImmutable = $longitude;
        return $this;
    }
}
