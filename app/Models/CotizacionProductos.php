<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionProductos extends Model
{
    use HasFactory;

    protected $fillable = [
        'ClaveProducto','CantidadProductos', 'IdCotizacion', 'Subtotal',
    ];


    protected $primaryKey = 'IdCotiProdu';

}
