<?php

declare(strict_types=1);

namespace App\ModelRoute\Composite\Entity;

use App\ValuesObjects\Id;

class RouteIdentifier
{
    public function __construct(
        private Id $identifier,
        private string $latitude,
        private string $longitude
    ) {}
}
