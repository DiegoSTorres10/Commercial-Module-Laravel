<?php

namespace Database\Seeders;

use App\Models\AccesoModulo;
use Illuminate\Database\Seeder;

class AccesoModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Modulo = new AccesoModulo();
        $Modulo->NombreModulo = "Módulo de Clientes";
        $Modulo->save();

        $Modulo = new AccesoModulo();
        $Modulo->NombreModulo = "Módulo de Proveedores";
        $Modulo->save();

        $Modulo = new AccesoModulo();
        $Modulo->NombreModulo = "Módulo de Almacen";
        $Modulo->save();

        $Modulo = new AccesoModulo();
        $Modulo->NombreModulo = "Módulo de Productos";
        $Modulo->save();
    }
}
