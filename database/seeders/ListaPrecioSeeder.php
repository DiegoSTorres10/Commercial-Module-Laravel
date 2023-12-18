<?php

namespace Database\Seeders;

use App\Models\ListasPrecio;
use Illuminate\Database\Seeder;

class ListaPrecioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $List = new ListasPrecio();
        $List->NombreLista = "Lista Básica";
        $List->Porcentaje = 5.00;
        $List->save();

        $List = new ListasPrecio();
        $List->NombreLista = "Lista Estándar";
        $List->Porcentaje = 10.00;
        $List->save();

        $List = new ListasPrecio();
        $List->NombreLista = "Lista Premium";
        $List->Porcentaje = 15.00;
        $List->save();

    }
}
