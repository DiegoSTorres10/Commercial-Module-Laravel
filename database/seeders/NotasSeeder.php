<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Nota;
use Illuminate\Database\Seeder;

class NotasSeeder extends Seeder
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
            Nota::factory()->create(['IdCliente' => $cliente->IdCliente]);
        }
    }
}
