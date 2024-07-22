<?php

namespace Tests\Feature\Auth;

use App\Enum\Rules\TypeRule;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    public function testShouldLoginUserWithSuccess(): void
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'afonso.afancar@magazineaziul.com.br',
            'password' => '123mudar'
        ]);

        $response->assertSuccessful();
        $this->assertIsString($response->json('access_token'));
        $this->assertIsInt($response->json('expires_in'));
        $this->assertIsArray($response->json('permissions'));
        $this->assertIsObject(TypeRule::tryFrom($response->json('rule')));
    }
}
