<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListasPrecio extends Model
{
    use HasFactory;

    protected $fillable = ['NombreLista', 'Porcentaje'];

    protected $primaryKey = 'IdLista';

    public function productosServicios (){
        return $this->hasMany('App\Models\ProductosServicio', 'IdLista', 'IdLista');
    }
}
