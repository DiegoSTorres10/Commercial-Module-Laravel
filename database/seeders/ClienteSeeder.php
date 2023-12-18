<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Telefono;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::factory(10)->create();
    }
}
