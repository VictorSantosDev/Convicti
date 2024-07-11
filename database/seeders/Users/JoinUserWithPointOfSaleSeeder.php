<?php

namespace Database\Seeders\Users;

use App\Models\PointOfSale;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Prompts\Progress;

use function Laravel\Prompts\progress;

class JoinUserWithPointOfSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collectionUserJoinPointOfSale = $this->collectionUserJoinPointOfSale();

        /** @var Progress $progress */
        $progress = progress(label: 'Join users with pont of sale', steps: count($collectionUserJoinPointOfSale));

        $progress->start();
        foreach ($collectionUserJoinPointOfSale as $userJoinPointOfSale) {
            $rowPointOfSale = PointOfSale::where(
                'name',
                $userJoinPointOfSale['name_point_of_sale']
            )->first();

            $rowUser = User::where(
                'email', 
                $userJoinPointOfSale['email_user']
            )->first();

            if (!$rowUser || !$rowPointOfSale) {
                $progress->advance();
                continue;
            }

            $rowUser->point_of_sale_id = $rowPointOfSale->id;
            $rowUser->save();

            $progress->advance();
        }
        $progress->finish();
    }
                
    private function collectionUserJoinPointOfSale(): array
    {
        return [
            [
                'email_user' => 'afonso.afancar@magazineaziul.com.br',
                'name_point_of_sale' => 'Belo Horizonte'
            ],
            [
                'email_user' => 'alceu.andreoli@magazineaziul.com.br',
                'name_point_of_sale' => 'Belo Horizonte'
            ],
            [
                'email_user' => 'amalia.zago@magazineaziul.com.br',
                'name_point_of_sale' => 'Belo Horizonte'
            ],
            [
                'email_user' => 'carlos.eduardo@magazineaziul.com.br',
                'name_point_of_sale' => 'Belo Horizonte'
            ],
            [
                'email_user' => 'luiz.felipe@magazineaziul.com.br',
                'name_point_of_sale' => 'Belo Horizonte'
            ],
            [
                'email_user' => 'breno@magazineaziul.com.br',
                'name_point_of_sale' => 'Campo Grande'
            ],
            [
                'email_user' => 'emanuel@magazineaziul.com.br',
                'name_point_of_sale' => 'Campo Grande'
            ],
            [
                'email_user' => 'ryan@magazineaziul.com.br',
                'name_point_of_sale' => 'Campo Grande'
            ],
            [
                'email_user' => 'vitor.hugo@magazineaziul.com.br',
                'name_point_of_sale' => 'Campo Grande'
            ],
            [
                'email_user' => 'yuri@magazineaziul.com.br',
                'name_point_of_sale' => 'Campo Grande'
            ],
            [
                'email_user' => 'benjamin@magazineaziul.com.br',
                'name_point_of_sale' => 'Cuiaba'
            ],
            [
                'email_user' => 'erick@magazineaziul.com.br',
                'name_point_of_sale' => 'Cuiaba'
            ],
            [
                'email_user' => 'enzo.gabriel@magazineaziul.com.br',
                'name_point_of_sale' => 'Cuiaba'
            ],
            [
                'email_user' => 'fernando@magazineaziul.com.br',
                'name_point_of_sale' => 'Cuiaba'
            ],
            [
                'email_user' => 'joaquim@magazineaziul.com.br',
                'name_point_of_sale' => 'Cuiaba'
            ],
            [
                'email_user' => 'andré@magazineaziul.com.br',
                'name_point_of_sale' => 'Curitiba'
            ],
            [
                'email_user' => 'raul@magazineaziul.com.br',
                'name_point_of_sale' => 'Curitiba'
            ],
            [
                'email_user' => 'marcelo@magazineaziul.com.br',
                'name_point_of_sale' => 'Curitiba'
            ],
            [
                'email_user' => 'julio.césar@magazineaziul.com.br',
                'name_point_of_sale' => 'Curitiba'
            ],
            [
                'email_user' => 'cauê@magazineaziul.com.br',
                'name_point_of_sale' => 'Curitiba'
            ],
            [
                'email_user' => 'benício@magazineaziul.com.br',
                'name_point_of_sale' => 'Florianopolis'
            ],
            [
                'email_user' => 'vitor.gabriel@magazineaziul.com.br',
                'name_point_of_sale' => 'Florianopolis'
            ],
            [
                'email_user' => 'augusto@magazineaziul.com.br',
                'name_point_of_sale' => 'Florianopolis'
            ],
            [
                'email_user' => 'pedro.lucas@magazineaziul.com.br',
                'name_point_of_sale' => 'Florianopolis'
            ],
            [
                'email_user' => 'luiz.gustavo@magazineaziul.com.br',
                'name_point_of_sale' => 'Florianopolis'
            ],
            [
                'email_user' => 'giovanni@magazineaziul.com.br',
                'name_point_of_sale' => 'Goiania'
            ],
            [
                'email_user' => 'renato@magazineaziul.com.br',
                'name_point_of_sale' => 'Goiania'
            ],
            [
                'email_user' => 'diego@magazineaziul.com.br',
                'name_point_of_sale' => 'Goiania'
            ],
            [
                'email_user' => 'joão.paulo@magazineaziul.com.br',
                'name_point_of_sale' => 'Goiania'
            ],
            [
                'email_user' => 'renan@magazineaziul.com.br',
                'name_point_of_sale' => 'Goiania'
            ],
            [
                'email_user' => 'luiz.fernando@magazineaziul.com.br',
                'name_point_of_sale' => 'Porto Alegre'
            ],
            [
                'email_user' => 'anthony@magazineaziul.com.br',
                'name_point_of_sale' => 'Porto Alegre'
            ],
            [
                'email_user' => 'lucas.gabriel@magazineaziul.com.br',
                'name_point_of_sale' => 'Porto Alegre'
            ],
            [
                'email_user' => 'thales@magazineaziul.com.br',
                'name_point_of_sale' => 'Porto Alegre'
            ],
            [
                'email_user' => 'luiz.miguel@magazineaziul.com.br',
                'name_point_of_sale' => 'Porto Alegre'
            ],
            [
                'email_user' => 'henry@magazineaziul.com.br',
                'name_point_of_sale' => 'Rio de Janeiro'
            ],
            [
                'email_user' => 'marcos.vinicius@magazineaziul.com.br',
                'name_point_of_sale' => 'Rio de Janeiro'
            ],
            [
                'email_user' => 'kevin@magazineaziul.com.br',
                'name_point_of_sale' => 'Rio de Janeiro'
            ],
            [
                'email_user' => 'levi@magazineaziul.com.br',
                'name_point_of_sale' => 'Rio de Janeiro'
            ],
            [
                'email_user' => 'enrico@magazineaziul.com.br',
                'name_point_of_sale' => 'Rio de Janeiro'
            ],
            [
                'email_user' => 'joão.lucas@magazineaziul.com.br',
                'name_point_of_sale' => 'Sao Paulo'
            ],
            [
                'email_user' => 'hugo@magazineaziul.com.br',
                'name_point_of_sale' => 'Sao Paulo'
            ],
            [
                'email_user' => 'luiz.guilherme@magazineaziul.com.br',
                'name_point_of_sale' => 'Sao Paulo'
            ],
            [
                'email_user' => 'matheus.henrique@magazineaziul.com.br',
                'name_point_of_sale' => 'Sao Paulo'
            ],
            [
                'email_user' => 'miguel@magazineaziul.com.br',
                'name_point_of_sale' => 'Sao Paulo'
            ],
            [
                'email_user' => 'davi@magazineaziul.com.br',
                'name_point_of_sale' => 'Vitória'
            ],
            [
                'email_user' => 'gabriel@magazineaziul.com.br',
                'name_point_of_sale' => 'Vitória'
            ],
            [
                'email_user' => 'arthur@magazineaziul.com.br',
                'name_point_of_sale' => 'Vitória'
            ],
            [
                'email_user' => 'lucas@magazineaziul.com.br',
                'name_point_of_sale' => 'Vitória'
            ],
            [
                'email_user' => 'matheus@magazineaziul.com.br',
                'name_point_of_sale' => 'Vitória'
            ],
            [
                'email_user' => 'ronaldinho.gaucho@magazineaziul.com.br',
                'name_point_of_sale' => 'Porto Alegre'
            ],
            [
                'email_user' => 'roberto.firmino@magazineaziul.com.br',
                'name_point_of_sale' => 'Florianopolis'
            ],
            [
                'email_user' => 'alex.de.souza@magazineaziul.com.br',
                'name_point_of_sale' => 'Curitiba'
            ],
            [
                'email_user' => 'françoaldo.souza@magazineaziul.com.br',
                'name_point_of_sale' => 'Sao Paulo'
            ],
            [
                'email_user' => 'romário.faria@magazineaziul.com.br',
                'name_point_of_sale' => 'Rio de Janeiro'
            ],
            [
                'email_user' => 'ricardo.goulart@magazineaziul.com.br',
                'name_point_of_sale' => 'Belo Horizonte'
            ],
            [
                'email_user' => 'dejan.petkovic@magazineaziul.com.br',
                'name_point_of_sale' => 'Vitória'
            ],
            [
                'email_user' => 'deyverson.acosta@magazineaziul.com.br',
                'name_point_of_sale' => 'Campo Grande'
            ],
            [
                'email_user' => 'harlei.silva@magazineaziul.com.br',
                'name_point_of_sale' => 'Goiania'
            ],
            [
                'email_user' => 'walter.henrique@magazineaziul.com.br',
                'name_point_of_sale' => 'Cuiaba'
            ],
        ];
    }
}
