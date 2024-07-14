<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Domain\User\Services\UserService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function listAction()
    {
        try{
            $output = $this->userService->list($request->all());
            return response()->json($output, JsonResponse::HTTP_OK);
        } catch(Exception $e) {
            return response()->json(
                ['error' => $e->getMessage()],
                $e->getCode() !== 0 ? $e->getCode() : JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
