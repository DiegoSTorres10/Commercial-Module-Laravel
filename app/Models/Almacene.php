<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Almacene extends Model
{

    use HasFactory;

    protected $fillable = [
        'IdAlmacen','NombreAlmacen', 'DescripcionAlmacen', 'NumeroTelefonico',  'Calle',
        'NoExterior', 'Nointerior', 'Colonia', 'Municipio', 'Estado', 'ClavePais',
        'CP',
    ];
    protected $primaryKey = 'IdAlmacen';

    public function paises (){
        return $this->belongsTo('App\Models\Paise', 'ClavePais', 'ClavePais');
    }

    

    public function productos(){
        return $this->belongsToMany('App\Models\ProductosServicio', 'almacenes_productos', 'IdAlmacen','ClaveProducto')
        ->withPivot('IdInventario', 'IdAlmacen', 'ClaveProducto', 'CantidadProductos');
    }

    public function Cotizaciones (){
        return $this->hasMany(Cotizacione::class, 'IdAlmacen', 'IdAlmacen');
    }


    public function CajasVentas (){
        return $this->hasMany(CajasVenta::class, 'IdAlmacen', 'IdAlmacen');
    }
}
