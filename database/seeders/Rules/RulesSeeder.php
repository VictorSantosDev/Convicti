<?php

namespace Database\Seeders\Rules;

use App\Models\Rules;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Prompts\Progress;

use function Laravel\Prompts\progress;

class RulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collectionRules = $this->collectionRules();

        /** @var Progress $progress */
        $progress = progress(label: 'Insert rules', steps: count($collectionRules));

        $progress->start();
        foreach ($collectionRules as $rule) {
            Rules::create(['type' => $rule]);
            $progress->advance();
        }
        $progress->finish();
    }

    private function collectionRules(): array
    {
        return [
            'SELLER',
            'MANAGE',
            'BOARD',
            'GENERAL_BOARD',
        ];
    }
}
