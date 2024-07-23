<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\Board;

use App\Domain\Board\Entity\Board;
use App\Domain\Board\Factories\Factory\BoardFactory;
use App\Domain\Board\Infrastructure\Repository\BoardRepositoryInterface;
use App\Models\Board as Model;
use App\ValuesObjects\Id;

class BoardRepository implements BoardRepositoryInterface
{
    public function __construct(private Model $db) {}

    public function findAllWithFilter(?string $name, int $limit): array
    {
        $row = $this->db::where('name_board', 'LIKE', "$name%");
        return $row->paginate($limit)->toArray();
    }

    public function findByIdUserTryFrom(Id $id): ?Board
    {
        $row = $this->db::where('user_id', $id->get())->first();

        if (!$row) {
            return null;
        }

        $boardFactory = new BoardFactory;
        return $boardFactory->getBoard(
            id: $row->id,
            userId: $row->user_id,
            nameBoard: $row->name_board,
            createdAt: $row->created_at?->format('Y-m-d H:i:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:i:s')
        );
    }
}
