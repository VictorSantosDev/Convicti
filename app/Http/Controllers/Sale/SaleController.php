<?php

namespace App\Http\Controllers\Sale;

use App\Domain\Sale\Services\SaleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\CreateSaleRequest;
use App\Http\Requests\Sale\ListSaleRequest;
use App\Http\Requests\Sale\ShowSaleRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    public function __construct(private SaleService $saleService) {}

    public function createAction(CreateSaleRequest $request): JsonResponse
    {
        try{
            $output = $this->saleService->create($request->data());
            return response()->json($output->jsonSerialize(), JsonResponse::HTTP_OK);
        } catch(Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                $e->getCode() !== 0 ? $e->getCode() : JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    public function showAction(ShowSaleRequest $request, int $id): JsonResponse
    {
        try{
            $output = $this->saleService->show($id);
            return response()->json($output, JsonResponse::HTTP_OK);
        } catch(Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                $e->getCode() !== 0 ? $e->getCode() : JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    public function listAction(ListSaleRequest $request): JsonResponse
    {
        try{
            $output = $this->saleService->list($request->all());
            return response()->json($output, JsonResponse::HTTP_OK);
        } catch(Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                $e->getCode() !== 0 ? $e->getCode() : JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
