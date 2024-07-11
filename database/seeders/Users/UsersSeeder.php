<?php

namespace Database\Seeders\Users;

use App\Models\Rules;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Prompts\Progress;

use function Laravel\Prompts\progress;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collectionUsers = $this->collectionUsers();

        /** @var Progress $progress */
        $progress = progress(label: 'Insert users', steps: count($collectionUsers));

        $progress->start();
        foreach ($collectionUsers as $user) {
            $row = Rules::where('type', $user['rule_type'])->first();
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('123mudar'),
                'rule_id' => $row->id
            ]);
            $progress->advance();
        }
        $progress->finish();
    }

    private function collectionUsers(): array
    {
        return [
            [
                'name' => 'Afonso Afancar',
                'email' => 'afonso.afancar@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Alceu Andreoli',
                'email' => 'alceu.andreoli@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Amalia Zago',
                'email' => 'amalia.zago@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Carlos Eduardo',
                'email' => 'carlos.eduardo@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Luiz Felipe',
                'email' => 'luiz.felipe@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Breno',
                'email' => 'breno@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Emanuel',
                'email' => 'emanuel@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Ryan',
                'email' => 'ryan@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Vitor Hugo',
                'email' => 'vitor.hugo@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Yuri',
                'email' => 'yuri@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Benjamin',
                'email' => 'benjamin@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Erick',
                'email' => 'erick@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Enzo Gabriel',
                'email' => 'enzo.gabriel@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Fernando',
                'email' => 'fernando@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Joaquim',
                'email' => 'joaquim@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'André',
                'email' => 'andré@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Raul',
                'email' => 'raul@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Marcelo',
                'email' => 'marcelo@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Julio César',
                'email' => 'julio.césar@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Cauê',
                'email' => 'cauê@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Benício',
                'email' => 'benício@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Vitor Gabriel',
                'email' => 'vitor.gabriel@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Augusto',
                'email' => 'augusto@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Pedro Lucas',
                'email' => 'pedro.lucas@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Luiz Gustavo',
                'email' => 'luiz.gustavo@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Giovanni',
                'email' => 'giovanni@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Renato',
                'email' => 'renato@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Diego',
                'email' => 'diego@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'João Paulo',
                'email' => 'joão.paulo@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Renan',
                'email' => 'renan@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Luiz Fernando',
                'email' => 'luiz.fernando@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Anthony',
                'email' => 'anthony@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Lucas Gabriel',
                'email' => 'lucas.gabriel@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Thales',
                'email' => 'thales@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Luiz Miguel',
                'email' => 'luiz.miguel@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Henry',
                'email' => 'henry@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Marcos Vinicius',
                'email' => 'marcos.vinicius@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Kevin',
                'email' => 'kevin@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Levi',
                'email' => 'levi@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Enrico',
                'email' => 'enrico@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'João Lucas',
                'email' => 'joão.lucas@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Hugo',
                'email' => 'hugo@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Luiz Guilherme',
                'email' => 'luiz.guilherme@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Matheus Henrique',
                'email' => 'matheus.henrique@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Miguel',
                'email' => 'miguel@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Davi',
                'email' => 'davi@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Gabriel',
                'email' => 'gabriel@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Arthur',
                'email' => 'arthur@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Lucas',
                'email' => 'lucas@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Matheus',
                'email' => 'matheus@magazineaziul.com.br',
                'rule_type' => 'SELLER',
            ],
            [
                'name' => 'Ronaldinho Gaucho',
                'email' => 'ronaldinho.gaucho@magazineaziul.com.br',
                'rule_type' => 'MANAGE',
            ],
            [
                'name' => 'Roberto Firmino',
                'email' => 'roberto.firmino@magazineaziul.com.br',
                'rule_type' => 'MANAGE',
            ],
            [
                'name' => 'Alex de Souza',
                'email' => 'alex.de.souza@magazineaziul.com.br',
                'rule_type' => 'MANAGE',
            ],
            [
                'name' => 'Françoaldo Souza',
                'email' => 'françoaldo.souza@magazineaziul.com.br',
                'rule_type' => 'MANAGE',
            ],
            [
                'name' => 'Romário Faria',
                'email' => 'romário.faria@magazineaziul.com.br',
                'rule_type' => 'MANAGE',
            ],
            [
                'name' => 'Ricardo Goulart',
                'email' => 'ricardo.goulart@magazineaziul.com.br',
                'rule_type' => 'MANAGE',
            ],
            [
                'name' => 'Dejan Petkovic',
                'email' => 'dejan.petkovic@magazineaziul.com.br',
                'rule_type' => 'MANAGE',
            ],
            [
                'name' => 'Deyverson Acosta',
                'email' => 'deyverson.acosta@magazineaziul.com.br',
                'rule_type' => 'MANAGE',
            ],
            [
                'name' => 'Harlei Silva',
                'email' => 'harlei.silva@magazineaziul.com.br',
                'rule_type' => 'MANAGE',
            ],
            [
                'name' => 'Walter Henrique',
                'email' => 'walter.henrique@magazineaziul.com.br',
                'rule_type' => 'MANAGE',
            ],
            [
                'name' => 'Vagner Mancini',
                'email' => 'vagner.mancini@magazineaziul.com.br',
                'rule_type' => 'BOARD',
            ],
            [
                'name' => 'Abel Ferreira',
                'email' => 'abel.ferreira@magazineaziul.com.br',
                'rule_type' => 'BOARD',
            ],
            [
                'name' => 'Rogerio Ceni',
                'email' => 'rogerio.ceni@magazineaziul.com.br',
                'rule_type' => 'BOARD',
            ],
            [
                'name' => 'Edson A. do Nascimento',
                'email' => 'pele@magazineaziul.com.br',
                'rule_type' => 'GENERAL_BOARD',
            ],
        ];
    }
}
