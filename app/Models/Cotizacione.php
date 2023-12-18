<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacione extends Model
{
    use HasFactory;

    protected $fillable = [
        'FechaCotizacion','NombreElaborador', 'IdAlmacen', 'IdCliente', 'FechaVencimiento',
        'Descuento', 'TotalPagar'
    ];


    protected $primaryKey = 'IdCotizacion';


    public function productos_cotizaciones (){
        return $this->belongsToMany(ProductosServicio::class ,'cotizacion_productos', 'IdCotizacion', 'ClaveProducto')
        ->withPivot('IdCotiProdu', 'ClaveProducto', 'CantidadProductos', 'IdCotizacion', 'Subtotal');
    }

    public function Almacenes (){
        return $this->belongsTo(Almacene::class, 'IdAlmacen', 'IdAlmacen');
    }

    public function Clientes (){
        return $this->belongsTo(Cliente::class, 'IdCliente', 'IdCliente');
    }
}
