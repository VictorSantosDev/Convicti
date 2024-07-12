<?php

namespace App\Http\Controllers\Sale;

use App\Domain\Sale\Services\SaleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\CreateSaleRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(private SaleService $saleService) {}

    public function createAction(CreateSaleRequest $request): JsonResponse
    {
        try{
            $output = $this->saleService->create($request->data());
            dd($output);
        } catch(Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                $e->getCode() ?? JsonResponse::HTTP_PAYMENT_REQUIRED
            );
        }
    }
}
