<?php

namespace App\Http\Controllers\ModuloAlmacen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlmaceneContoller extends Controller
{
    public function index (){
        return view ('ModuloAlmacen.index');
        
    }
}
