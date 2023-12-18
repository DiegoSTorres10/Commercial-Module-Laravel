<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductosServicio extends Model
{
    use HasFactory;

    protected $fillable = ['ClaveProducto', 'IdTipo', 'Clasificador', 'UnidadMedida', 'Nombre', 'Descripcion', 'Precio'];

    protected $primaryKey = 'ClaveProducto';
    protected $keyType = 'string';


    public function tipoSerProductos (){
        return $this->belongsTo('App\Models\TipoProdServicio', 'IdTipo', 'IdTipo');
    }

    public function proveedores(){
        return $this->belongsToMany('App\Models\Proveedore', 'productos_proveedores', 'ClaveProducto','IdProveedor')
        ->withPivot('CostoProveedor', 'IdTipoMoneda', 'FechaCotizacion', 'ProveedorSeleccionado');
    }

    public function listasPrecios(){
        return $this->belongsTo('App\Models\ListasPrecio', 'IdLista','IdLista');
    }

    public function almacenes (){
        return $this->belongsToMany('App\Models\Almacene', 'almacenes_productos', 'ClaveProducto' ,'IdAlmacen')
        ->withPivot('IdInventario', 'IdAlmacen', 'ClaveProducto', 'CantidadProductos');
    }

    public function productos_cotizaciones (){
        return $this->belongsToMany(Cotizacione::class ,'cotizacion_productos', 'ClaveProducto', 'IdCotizacion')
        ->withPivot('IdCotiProdu', 'ClaveProducto', 'CantidadProductos', 'IdCotizacion', 'Subtotal');
    }

    public function productos_venta (){
        return $this->belongsToMany(Venta::class ,'detalles_ventas', 'ClaveProducto', 'IdVenta')
        ->withPivot('IdDetalle', 'ClaveProducto', 'CantidadProductos', 'Subtotal');
    }
}
