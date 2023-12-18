<?php

namespace Database\Seeders;

use App\Models\TipoProdServicio;
use Illuminate\Database\Seeder;

class TipoProdServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Tipo = new TipoProdServicio();
        $Tipo->Tipo="Producto";
        $Tipo->save();

        $Tipo = new TipoProdServicio();
        $Tipo->Tipo="Servicio";
        $Tipo->save();
    }
}
