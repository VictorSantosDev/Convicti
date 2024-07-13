<?php

declare(strict_types=1);

namespace App\Domain\Sale\Infrastructure\Entity;

use App\Domain\Sale\Entity\Sale;

interface SaleEntityInterface
{
    public function create(Sale $sale): Sale;
}
