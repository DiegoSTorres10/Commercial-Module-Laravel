<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Telefono;
use Illuminate\Database\Seeder;

class TelefonosSeeder extends Seeder
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
            Telefono::factory()->create(['IdCliente' => $cliente->IdCliente]);
        }
    }

}
