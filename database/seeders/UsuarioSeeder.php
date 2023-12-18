<?php

namespace Database\Seeders;

use App\Models\AccesoModulo;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = new User();
        $usuario->name="Administrador";
        $usuario->email="Administrador@gmail.com";
        $usuario->password=bcrypt("Imperio11@");
        $usuario->cargo = "Administrador";
        $usuario->save();

        $usuario->modules()->sync([1, 2, 3, 4]);


    }
}
