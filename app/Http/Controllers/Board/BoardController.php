<?php

declare(strict_types=1);

namespace App\Http\Controllers\Board;

use App\Domain\Board\Services\BoardService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Board\ListRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class BoardController extends Controller
{
    public function __construct(private BoardService $boardService) {}

    public function listAction(ListRequest $request): JsonResponse
    {
        try{
            $output = $this->boardService->list(
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
