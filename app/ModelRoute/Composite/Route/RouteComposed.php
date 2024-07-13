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
        /** @var RouteLeaf $route */
        foreach ($this->routesCollection as $route) {
            $router = $route->getRouteIdentifier();

            $kms = Distance::calculate(
                latitudeTo: $this->latitudeImmutable,
                longitudeTo: $this->longitudeImmutable,
                latitudeFrom: $router->getLatitude(),
                longitudeFrom: $router->getLongitude(),
            );

            $route->setDistance($kms);
        }

        usort($this->routesCollection, function ($routeCurrent, $routeNext) {
            $routerIdentifieCurrent = $routeCurrent->getRouteIdentifier();
            $routerIdentifieNext = $routeNext->getRouteIdentifier();

            if (
                is_null($routerIdentifieCurrent->getDistanceByPoint()) || 
                is_null($routerIdentifieNext->getDistanceByPoint())
            ) {
                return 0;
            }

            if (
                $routerIdentifieCurrent->getDistanceByPoint() == $routerIdentifieNext->getDistanceByPoint()
            ) {
                return 0;
            }

            return ($routerIdentifieCurrent->getDistanceByPoint() < $routerIdentifieNext->getDistanceByPoint()) ? -1 : 1;
        });

        /** @var RouteLeaf $routerLeaf */
        $routerLeaf = array_shift($this->routesCollection);

        return $routerLeaf->getRouteIdentifier();
    }

    public function setLatitude(string $latitude): void
    {
        $this->latitudeImmutable = $latitude;
    }

    public function setLongitude(string $longitude): void
    {
        $this->longitudeImmutable = $longitude;
    }
}
