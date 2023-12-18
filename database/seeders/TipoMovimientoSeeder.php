<?php

namespace Database\Seeders;

use App\Models\TipoMovimiento;
use Illuminate\Database\Seeder;

class TipoMovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $tipo = new TipoMovimiento();
        $tipo->IdTipo='Ent';
        $tipo->TipoMovimiento = 'Entrada';
        $tipo->save();

        $tipo = new TipoMovimiento();
        $tipo->IdTipo='Sal';
        $tipo->TipoMovimiento = 'Salida';
        $tipo->save();

    }
}
