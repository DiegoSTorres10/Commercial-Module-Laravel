<?php

namespace Database\Seeders;

use App\Models\TipoCliente;
use Illuminate\Database\Seeder;

class TipoClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $TCliente = new TipoCliente();
        $TCliente->ClaveTipo = "CNA";
        $TCliente->Descripcion = "Cliente Nacional";
        $TCliente->save();

        $TCliente = new TipoCliente();
        $TCliente->ClaveTipo = "CNI";
        $TCliente->Descripcion = "Cliente Internacional";
        $TCliente->save();
    }
}
