<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = [
        'IdCliente', 'FechaHora', 'IdCaja', 'Descuento', 'TotalPagar'
    ];
    protected $primaryKey = 'IdVenta';

    public function CajaVentas()
    {
        return $this->belongsTo(CajasVenta::class, 'IdCaja', 'IdCaja');
    }

    public function Clientes()
    {
        return $this->belongsTo(Cliente::class, 'IdCliente', 'IdCliente');
    }

    public function productos_venta()
    {
        return $this->belongsToMany(ProductosServicio::class, 'detalles_ventas', 'IdVenta', 'ClaveProducto')
            ->withPivot('IdDetalle', 'ClaveProducto', 'CantidadProductos', 'Subtotal');
    }

    public function PagosDeVenta()
    {
        return $this->hasMany(PagosVenta::class, 'IdVenta', 'IdVenta');
    }
}
