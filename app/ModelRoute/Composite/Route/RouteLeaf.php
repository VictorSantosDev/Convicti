<?php

declare(strict_types=1);

namespace App\ModelRoute\Composite\Route;

use App\ModelRoute\Composite\Entity\RouteIdentifier;
use App\ModelRoute\Composite\Route\RouteComponent;

class RouteLeaf extends RouteComponent
{
    public function __construct(private RouteIdentifier $routeIdentifier) {}

    public function setDistance(?string $distance): void
    {
        $this->routeIdentifier->setDistanceByPoint($distance);
    }

    public function getRouteIdentifier(): RouteIdentifier
    {
        return $this->routeIdentifier;
    }
}
