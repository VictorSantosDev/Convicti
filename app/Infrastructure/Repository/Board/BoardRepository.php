<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\Board;

use App\Domain\Board\Infrastructure\Repository\BoardRepositoryInterface;
use App\Models\Board as Model;

class BoardRepository implements BoardRepositoryInterface
{
    public function __construct(private Model $db) {}

    public function findAllWithFilter(?string $name, int $limit): array
    {
        $row = $this->db::where('name_board', 'LIKE', "$name%");
        return $row->paginate($limit)->toArray();
    }
}
