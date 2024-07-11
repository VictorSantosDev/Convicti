<?php

namespace Database\Seeders\PointOfSale;

use App\Models\Board;
use App\Models\PointOfSale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Prompts\Progress;

use function Laravel\Prompts\progress;

class PointOfSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collectionPointOfSales = $this->collectionPointOfSales();
    
        /** @var Progress $progress */
        $progress = progress(label: 'Insert Point Of Sales', steps: count($collectionPointOfSales));

        $progress->start();
        foreach ($collectionPointOfSales as $pointOfSale) {
            $row = Board::where('name_board', $pointOfSale['name_board'])->first();

            PointOfSale::create([
                'board_id' => $row->id,
                'name' => $pointOfSale['name'],
                'latitude' => $pointOfSale['latitude'],
                'longitude' => $pointOfSale['longitude'],
            ]);
            $progress->advance();
        }
        $progress->finish();
    }

    private function collectionPointOfSales(): array
    {
        return [
            [
                'name_board' => 'Sul',
                'name' => 'Porto Alegre',
                'latitude' => '-30.048750057541955',
                'longitude' => '-51.228587422990806',
            ],
            [
                'name_board' => 'Sul',
                'name' => 'Florianopolis',
                'latitude' => '-27.55393525017396',
                'longitude' => '-48.49841515885026',
            ],
            [
                'name_board' => 'Sul',
                'name' => 'Curitiba',
                'latitude' => '-25.473704465731746',
                'longitude' => '-49.24787198992874',
            ],
            [
                'name_board' => 'Sudeste',
                'name' => 'Sao Paulo',
                'latitude' => '-23.544259437612844',
                'longitude' => '-46.64370714029131',
            ],
            [
                'name_board' => 'Sudeste',
                'name' => 'Rio de Janeiro',
                'latitude' => '-22.923447510604802',
                'longitude' => '-43.23208495438858',
            ],
            [
                'name_board' => 'Sudeste',
                'name' => 'Belo Horizonte',
                'latitude' => '-19.917854829716372',
                'longitude' => '-43.94089385954766',
            ],
            [
                'name_board' => 'Sudeste',
                'name' => 'Vitória',
                'latitude' => '-20.340992420772206',
                'longitude' => '-40.38332271475097',
            ],
            [
                'name_board' => 'Centro-oeste',
                'name' => 'Campo Grande',
                'latitude' => '-20.462652006300377',
                'longitude' => '-54.615658937666645',
            ],
            [
                'name_board' => 'Centro-oeste',
                'name' => 'Goiania',
                'latitude' => '-16.673126240814387',
                'longitude' => '-49.25248826354209',
            ],
            [
                'name_board' => 'Centro-oeste',
                'name' => 'Cuiaba',
                'latitude' => '-15.601754458320842',
                'longitude' => '-56.09832706558089',
            ],
        ];
    }
}
