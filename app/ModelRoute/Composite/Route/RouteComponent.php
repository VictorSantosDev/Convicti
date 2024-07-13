<?php

declare(strict_types=1);

namespace App\ModelRoute\Composite\Route;

use App\ModelRoute\Composite\Entity\RouteIdentifier;

abstract class RouteComponent
{
    public function add(RouteComponent ...$route): self {
        return $this;
    }
}
