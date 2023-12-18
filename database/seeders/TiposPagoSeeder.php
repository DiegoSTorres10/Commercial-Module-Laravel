<?php

namespace Database\Seeders;

use App\Models\TiposPago;
use Illuminate\Database\Seeder;

class TiposPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $NuevoPago = new TiposPago();
        $NuevoPago->TipoPago = 'Tarjeta de Credito/Débito';
        $NuevoPago->save();


        $NuevoPago = new TiposPago();
        $NuevoPago->TipoPago = 'Efectivo';
        $NuevoPago->save();


    }
}
