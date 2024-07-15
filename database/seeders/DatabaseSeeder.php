<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Board\BoardSeeder;
use Database\Seeders\PointOfSale\PointOfSaleSeeder;
use Database\Seeders\RuleHasPermission\JoinRulesWithPermission;
use Database\Seeders\Rules\RulesSeeder;
use Database\Seeders\Users\JoinUserWithPointOfSaleSeeder;
use Database\Seeders\Users\UsersSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RulesSeeder::class,
            UsersSeeder::class,
            BoardSeeder::class,
            PointOfSaleSeeder::class,
            JoinUserWithPointOfSaleSeeder::class,
            JoinRulesWithPermission::class
        ]);
    }
}
