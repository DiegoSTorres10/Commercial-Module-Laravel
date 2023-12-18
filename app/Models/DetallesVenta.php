<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesVenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'IdVenta','ClaveProducto', 'CantidadProductos', 'Subtotal',
    ];
    protected $primaryKey = 'IdDetalle';
}
