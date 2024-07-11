<?php

declare(strict_types=1);

namespace App\ValuesObjects;

class Id
{
    public function __construct(private ?int $id) {}

    public function get(): ?int
    {
        return $this->id;
    }

    static public function set(?int $id): self
    {
        return new self($id);
    }
}
