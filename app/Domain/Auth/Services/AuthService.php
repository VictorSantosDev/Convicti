<?php

declare(strict_types=1);

namespace App\Domain\Auth\Services;

use App\Domain\Rules\Services\RulesServices;
use App\Domain\User\Factories\Factory\UserFactory;
use App\ValuesObjects\Id;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthService
{
    public function __construct(private RulesServices $rulesServices) {}

    public function login(string $email, string $password): array
    {
        $token = auth()->attempt(['email' => $email, 'password' => $password]);

        if (!$token) {
            throw new Exception('Senha ou email inválido(s)', JsonResponse::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken((string) $token);
    }

    public function me(): array
    {
        $user = auth()->user();

        $user = (new UserFactory)->getUser(
            id: $user->id,
            ruleId: $user->rule_id,
            pointOfSaleId: $user->point_of_sale_id,
            name: $user->name,
            email: $user->email,
            emailVerifiedAt: $user->email_verified_at?->format('Y-m-d H:i:s'),
            password: $user->password,
            rememberToken: $user->remember_token,
            createdAt: $user->created_at?->format('Y-m-d H:i:s'),
            updatedAt: $user->updated_at?->format('Y-m-d H:i:s')
        );

        $permissions = $this->rulesServices->findAllRulesWithPermissions($user->getRuleId());

        return array_merge(
            $user->jsonSerialize(), 
            [
                'permissions' => $permissions
            ]
        );
    }

    public function logout(): void
    {
        auth()->logout();
    }

    public function refresh(): array
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken(string $token): array
    {
        $user = auth()->user();
        $permissions = $this->rulesServices->findAllRulesWithPermissions(
            Id::set($user->rule_id)
        );

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'permissions' => $permissions
        ];
    }
}
