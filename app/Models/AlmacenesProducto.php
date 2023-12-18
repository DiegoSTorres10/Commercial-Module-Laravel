<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AlmacenesProducto extends Model
{
    use HasFactory;


    protected $fillable = [
        'IdAlmacen','ClaveProducto', 'CantidadProductos'
    ];


    protected $primaryKey = 'IdInventario';

    public function registros_movimientos(){
        return $this->hasMany('App\Models\RegistrosMovimiento','IdInventario', 'IdInventario');
    }
}
