<?php

declare(strict_types=1);

namespace App\ModelRoute\Factories\Factory;

use App\ModelRoute\Composite\Entity\RouteIdentifier;

abstract class RouteIdentifierAbstract
{
    abstract public function getRouteIdentifier(
        int $identifier,
        string $latitude,
        string $longitude
    ): RouteIdentifier;
}
