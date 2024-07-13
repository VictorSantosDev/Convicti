<?php

declare(strict_types=1);

namespace App\Domain\Route\Services;

use App\Domain\PointOfSale\Entity\PointOfSale;
use App\ModelRoute\Composite\Entity\RouteIdentifier;
use App\ModelRoute\Composite\Route\RouteComposed;
use App\ModelRoute\Factories\Factory\RouteIdentifierFactory;
use App\ModelRoute\Composite\Route\RouteLeaf;

class RouteService
{
    /** @param PointOfSale[] $pointOfSaleCollection */
    public function nearRouteByPointOfSale(
        array $pointOfSaleCollection,
        string $latitude,
        string $longitude
    ): RouteIdentifier {
        $routeComposed = new RouteComposed();
        $routeComposed->setLatitude($latitude);
        $routeComposed->setLongitude($longitude);

        foreach ($pointOfSaleCollection as $pointOfSale) {
            $routeIdentifierFactory = new RouteIdentifierFactory;
            $route = new RouteLeaf(
                $routeIdentifierFactory->getRouteIdentifier(
                    identifier: $pointOfSale->getId()->get(),
                    latitude: $pointOfSale->getLatitude(),
                    longitude: $pointOfSale->getLongitude(),
                )
            );
            $routeComposed->add($route);
        }

        return $routeComposed->getNearRoute();
    }
}
