<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Domain\Auth\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService){}

    public function loginAction(LoginRequest $request): JsonResponse
    {
        try{
            $token = $this->authService->login($request->input('email'), $request->input('password'));
            return response()->json($token, JsonResponse::HTTP_OK);
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function meAction(): JsonResponse
    {
        try{
            $me = $this->authService->me();
            return response()->json($me, JsonResponse::HTTP_OK);
        } catch(Exception) {
            return response()->json(
                ['error' => 'Não foi possível obter os dados'],
                JsonResponse::HTTP_UNAUTHORIZED
            );
        }
    }

    public function logoutAction(): JsonResponse
    {
        try{
            $this->authService->logout();
            return response()->json(
                ['message' => 'Usuário deslogado com sucesso!'],
                JsonResponse::HTTP_OK
            );
        } catch(Exception) {
            return response()->json(
                ['error' => 'Não foi possível deslogar o usuário'],
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    public function refreshAction(): JsonResponse
    {
        try{
            $refresh = $this->authService->refresh();
            return response()->json($refresh, JsonResponse::HTTP_OK);
        } catch(Exception) {
            return response()->json(
                ['error' => 'Não foi possível obter o token atualizado'],
                JsonResponse::HTTP_UNAUTHORIZED
            );
        }
    }
}
