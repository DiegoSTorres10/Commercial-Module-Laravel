<?php

namespace Database\Seeders;

use App\Models\Razone;
use Illuminate\Database\Seeder;

class RazonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $razon = new Razone();
        $razon->Razon = 'Recuperación';
        $razon->IdTipo='Ent';
        $razon->save();

        $razon = new Razone();
        $razon->Razon = 'Devolución de Consumo';
        $razon->IdTipo='Ent';
        $razon->save();

        $razon = new Razone();
        $razon->Razon = 'Inventario Físico de Entrada';
        $razon->IdTipo='Ent';
        $razon->save();

        $razon = new Razone();
        $razon->Razon = 'Devolución de Clientes';
        $razon->IdTipo='Ent';
        $razon->save();

        $razon = new Razone();
        $razon->Razon = 'Correción';
        $razon->IdTipo='Ent';
        $razon->save();

        $razon = new Razone();
        $razon->Razon = 'Inventario Inicial';
        $razon->IdTipo='Ent';
        $razon->save();



        $razon = new Razone();
        $razon->Razon = 'Premio';
        $razon->IdTipo='Sal';
        $razon->save();

        $razon = new Razone();
        $razon->Razon = 'Donación';
        $razon->IdTipo='Sal';
        $razon->save();

        $razon = new Razone();
        $razon->Razon = 'Merma';
        $razon->IdTipo='Sal';
        $razon->save();

        $razon = new Razone();
        $razon->Razon = 'Muestra';
        $razon->IdTipo='Sal';
        $razon->save();

        $razon = new Razone();
        $razon->Razon = 'Consumo';
        $razon->IdTipo='Sal';
        $razon->save();

        $razon = new Razone();
        $razon->Razon = 'Inventario Físico de Salida';
        $razon->IdTipo='Sal';
        $razon->save();

        $razon = new Razone();
        $razon->Razon = 'Promoción';
        $razon->IdTipo='Sal';
        $razon->save();


    }
}
