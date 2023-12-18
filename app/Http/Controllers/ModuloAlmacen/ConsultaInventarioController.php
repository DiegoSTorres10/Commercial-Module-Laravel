<?php

namespace App\Http\Controllers\ModuloAlmacen;

use App\Http\Controllers\Controller;
use App\Models\Almacene;
use App\Models\ProductosServicio;
use App\Models\TipoProdServicio;
use Illuminate\Http\Request;

class ConsultaInventarioController extends Controller
{
    public function consultaInventario(){

        return view('ModuloAlmacen.ConsultaInventario.consultaInventario');
    }
}
