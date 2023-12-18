<?php

namespace App\Http\Controllers\ModuloCliente;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ModuloClientesController extends Controller
{

    public function Index(){
        return view ('ModuloClientes.index');
    }


    
}
