<?php

declare(strict_types=1);

namespace App\ModelRoute\Factories\Factory;

use App\ModelRoute\Composite\Entity\RouteIdentifier;
use App\ValuesObjects\Id;

class RouteIdentifierFactory
{
    public function getRouteIdentifier(
        int $identifier,
        string $latitude,
        string $longitude
    ): RouteIdentifier {
        return new RouteIdentifier(
            new Id($identifier),
            $latitude,
            $longitude
        );
    }
}
