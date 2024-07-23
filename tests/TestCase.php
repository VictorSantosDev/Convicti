<?php

namespace Tests;

use Database\Seeders\Board\BoardSeeder;
use Database\Seeders\PointOfSale\PointOfSaleSeeder;
use Database\Seeders\Rules\RulesSeeder;
use Database\Seeders\Users\JoinUserWithPointOfSaleSeeder;
use Database\Seeders\Users\UsersSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

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
}
