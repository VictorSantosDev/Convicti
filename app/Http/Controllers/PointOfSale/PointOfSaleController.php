<?php

declare(strict_types=1);

namespace App\Http\Controllers\PointOfSale;

use App\Domain\PointOfSale\Services\PointOfSaleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PointOfSale\ListRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PointOfSaleController extends Controller
{
    public function __construct(private PointOfSaleService $pointOfSaleService) {}

    public function listAction(ListRequest $request): JsonResponse
    {
        try{
            $output = $this->pointOfSaleService->list(
                $request->input('name', null),
                (int) $request->input('limit', 10)
            );
            return response()->json($output, JsonResponse::HTTP_OK);
        } catch(Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                $e->getCode() !== 0 ? $e->getCode() : JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
