<?php

namespace Tests\Feature\Auth\Services;

use App\Enum\Rules\TypeRule;
use Database\Seeders\Board\BoardSeeder;
use Database\Seeders\PointOfSale\PointOfSaleSeeder;
use Database\Seeders\Rules\RulesSeeder;
use Database\Seeders\Users\JoinUserWithPointOfSaleSeeder;
use Database\Seeders\Users\UsersSeeder;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed([
            RulesSeeder::class,
            UsersSeeder::class,
            BoardSeeder::class,
            PointOfSaleSeeder::class,
            JoinUserWithPointOfSaleSeeder::class,
        ]);
    }

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
