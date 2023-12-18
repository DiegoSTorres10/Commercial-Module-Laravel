<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\DatosFacturacione;
use Illuminate\Database\Seeder;

class DatosFacturacioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientes = Cliente::all();

        foreach ($clientes as $cliente) {
            DatosFacturacione::factory()->create(['IdCliente' => $cliente->IdCliente]);
        }
    }
}
