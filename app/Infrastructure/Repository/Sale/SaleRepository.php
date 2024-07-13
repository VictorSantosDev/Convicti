<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\Sale;

use App\Domain\Sale\Entity\Sale;
use App\Domain\Sale\Factories\Factory\SaleFactory;
use App\Domain\Sale\Infrastructure\Repository\SaleRepositoryInterface;
use App\Enum\Rules\TypeRule;
use App\Models\Sales as Model;
use App\ValuesObjects\Id;
use Exception;
use Illuminate\Support\Facades\DB;

class SaleRepository implements SaleRepositoryInterface
{
    public function __construct(private Model $db) {}

    public function findByIdByUserId(Id $id, Id $userId, TypeRule $type): Sale
    {
        $row = DB::table('sales as s')
        ->select(['s.*']);

        if (TypeRule::SELLER->value === $type->value) {
            $row = $row->where('s.user_id', $userId->get());
        }
        
        if (TypeRule::MANAGE->value === $type->value) {
            $row = $row->join('point_of_sale as pts', 's.point_of_sale_id', '=', 'pts.id')
            ->join('users as u', 'pts.id', '=', 'u.point_of_sale_id')
            ->where('u.id', $userId->get());
        }

        if (TypeRule::BOARD->value === $type->value) {
            $row = $row->join('point_of_sale as pts', 's.point_of_sale_id', '=', 'pts.id')
            ->join('board as b', 'pts.board_id', '=', 'b.id')
            ->where('b.user_id', $userId->get());
        }

        $row = $row->where('s.id', $id->get())->get()->first();

        if (!$row) {
            throw new Exception('Venda não encontrada');
        }

        $saleFactory = new SaleFactory;
        return $saleFactory->getSale(
            id: $row->id,
            userId: $row->user_id,
            pointOfSaleId: $row->point_of_sale_id,
            nearPointOfSaleId: $row->near_point_of_sale_id,
            saleValues: $row->sale_values,
            date: $row->date,
            hour: $row->hour,
            kmNearPointOfSale: $row->km_near_point_of_sale,
            latitude: $row->latitude,
            longitude: $row->longitude,
            isRoaming: $row->is_roaming === 1 ? true : false,
            createdAt: $row->created_at,
            updatedAt: $row->updated_at
        );
    }

    public function findAllWithFilter(
        string $dateInitial,
        string $dateFinal,
        Id $userId,
        Id $pointOfSaleId,
        Id $boardId,
        TypeRule $type
    ): array {
        $row = DB::table('sales as s')
        ->select(['s.*']);

        if (TypeRule::SELLER->value === $type->value) {
            $row = $row->where('s.user_id', $userId->get());
        }
        
        if (TypeRule::MANAGE->value === $type->value) {
            $row = $row->join('point_of_sale as pts', 's.point_of_sale_id', '=', 'pts.id')
            ->join('users as u', 'pts.id', '=', 'u.point_of_sale_id')
            ->where('u.id', $userId->get());
        }

        if (TypeRule::BOARD->value === $type->value) {
            $row = $row->join('point_of_sale as pts', 's.point_of_sale_id', '=', 'pts.id')
            ->join('board as b', 'pts.board_id', '=', 'b.id')
            ->where('b.user_id', $userId->get());
        }

        if (!$row) {
            throw new Exception('Venda não encontrada');
        }

        dd($row->toSql());
        dd($row->get()->toArray());
    }
}
