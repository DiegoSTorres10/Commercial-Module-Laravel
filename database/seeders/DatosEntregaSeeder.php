<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\DatosEntrega;
use App\Models\DatosFacturacione;
use Illuminate\Database\Seeder;

class DatosEntregaSeeder extends Seeder
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
            DatosEntrega::factory()->create(['IdCliente' => $cliente->IdCliente]);
        }
    }
}
