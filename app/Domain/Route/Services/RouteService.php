<?php

declare(strict_types=1);

namespace App\Domain\Route\Services;

use App\Domain\PointOfSale\Entity\PointOfSale;
use App\ModelRoute\Composite\Entity\RouteIdentifier;
use App\ModelRoute\Composite\Route\RouteComposed;
use App\ModelRoute\Factories\Factory\RouteIdentifierFactory;
use App\ModelRoute\Composite\Route\RouteLeaf;
use App\ValuesObjects\Id;

class RouteService
{
    /** @param PointOfSale[] $pointOfSaleCollection */
    public function nearRouteByPointOfSale(
        array $pointOfSaleCollection,

    ) {
        $routeComposed = new RouteComposed();
        $routeComposed->setLatitude('-23.6862475');
        $routeComposed->setLongitude('-46.5962964');

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

        dd($routeComposed->getNearRoute());
    }
}
