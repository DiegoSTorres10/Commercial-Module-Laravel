<?php

namespace Database\Seeders;

use App\Models\Almacene;
use Illuminate\Database\Seeder;

class AlmaceneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Almacen = new Almacene();
        $Almacen->NombreAlmacen = 'Almacen General';
        $Almacen->DescripcionAlmacen = 'Almacen central de la sucursales';
        $Almacen->NumeroTelefonico = '2229194152';
        $Almacen->Calle = 'Felipe de los Angeles';
        $Almacen->NoExterior = '25';
        $Almacen->Nointerior = 'A4';
        $Almacen->Colonia = 'San Pedro Cholula';
        $Almacen->Municipio = 'San Pedro Cholula';
        $Almacen->Estado = 'Puebla';
        $Almacen->ClavePais = 'MEX';
        $Almacen->CP = '74000';
        $Almacen->save();

        $Almacen = new Almacene();
        $Almacen->NombreAlmacen = 'Almacen del Sur';
        $Almacen->DescripcionAlmacen = 'Almacen sur electronica';
        $Almacen->NumeroTelefonico = '2229194152';
        $Almacen->Calle = 'Carril de San Miguel';
        $Almacen->NoExterior = '75';
        $Almacen->Nointerior = 'A4';
        $Almacen->Colonia = 'San Miguel';
        $Almacen->Municipio = 'Zacatlan';
        $Almacen->Estado = 'Puebla';
        $Almacen->ClavePais = 'MEX';
        $Almacen->CP = '74080';
        $Almacen->save();

        Almacene::factory(10)->create();

    }
}
