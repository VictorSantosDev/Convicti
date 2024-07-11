<?php

namespace Database\Seeders\Board;

use App\Models\Board;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Prompts\Progress;

use function Laravel\Prompts\progress;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collectionBoards = $this->collectionBoards();

        /** @var Progress $progress */
        $progress = progress(label: 'Insert boards', steps: count($collectionBoards));

        $progress->start();
        foreach ($collectionBoards as $board) {
            $row = User::where('email', $board['email_user'])->first();
            Board::create([
                'user_id' => $row->id,
                'name_board' => $board['name_board'],
            ]);
            $progress->advance();
        }
        $progress->finish();
    }

    
    private function collectionBoards(): array
    {
        return [
            [
                'email_user' => 'vagner.mancini@magazineaziul.com.br',
                'name_board' => 'Sul',
            ],
            [
                'email_user' => 'abel.ferreira@magazineaziul.com.br',
                'name_board' => 'Sudeste',
            ],
            [
                'email_user' => 'rogerio.ceni@magazineaziul.com.br',
                'name_board' => 'Centro-oeste',
            ],
        ];
    }
}
