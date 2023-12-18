<?php

namespace Database\Seeders;

use App\Models\TiposMoneda;
use Illuminate\Database\Seeder;

class TiposMonedasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposMoneda = [
            ['IdTipoMoneda' => 'USD', 'TipoMoneda' => 'Dólar estadounidense'],
            ['IdTipoMoneda' => 'EUR', 'TipoMoneda' => 'Euro'],
            ['IdTipoMoneda' => 'GBP', 'TipoMoneda' => 'Libra esterlina'],
            ['IdTipoMoneda' => 'JPY', 'TipoMoneda' => 'Yen japonés'],
            ['IdTipoMoneda' => 'CNY', 'TipoMoneda' => 'Yuan chino'],
            ['IdTipoMoneda' => 'CAD', 'TipoMoneda' => 'Dólar canadiense'],
            ['IdTipoMoneda' => 'AUD', 'TipoMoneda' => 'Dólar australiano'],
            ['IdTipoMoneda' => 'CHF', 'TipoMoneda' => 'Franco suizo'],
            ['IdTipoMoneda' => 'INR', 'TipoMoneda' => 'Rupia india'],
            ['IdTipoMoneda' => 'BRL', 'TipoMoneda' => 'Real brasileño'],
            ['IdTipoMoneda' => 'RUB', 'TipoMoneda' => 'Rublo ruso'],
            ['IdTipoMoneda' => 'MXN', 'TipoMoneda' => 'Peso mexicano'],
            ['IdTipoMoneda' => 'SGD', 'TipoMoneda' => 'Dólar de Singapur'],
            ['IdTipoMoneda' => 'KRW', 'TipoMoneda' => 'Won surcoreano'],
            ['IdTipoMoneda' => 'TRY', 'TipoMoneda' => 'Lira turca'],
            ['IdTipoMoneda' => 'ZAR', 'TipoMoneda' => 'Rand sudafricano'],
            ['IdTipoMoneda' => 'SEK', 'TipoMoneda' => 'Corona sueca'],
            ['IdTipoMoneda' => 'AED', 'TipoMoneda' => 'Dirham de los Emiratos Árabes Unidos'],
            ['IdTipoMoneda' => 'COP', 'TipoMoneda' => 'Peso colombiano'],
            ['IdTipoMoneda' => 'HKD', 'TipoMoneda' => 'Dólar de Hong Kong'],
            // Agrega más según sea necesario
        ];

        foreach ($tiposMoneda as $tipoMoneda) {
            $TipoMone = new TiposMoneda ();
            $TipoMone->IdTipoMoneda = $tipoMoneda['IdTipoMoneda'];
            $TipoMone->TipoMoneda = $tipoMoneda['TipoMoneda'];
            $TipoMone->save();
        }
    }
}
