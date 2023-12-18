<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposPago extends Model
{
    use HasFactory;
    protected $fillable = [
        'TipoPago'
    ];
    protected $primaryKey = 'IdTipoPago';

    public function PagoVentas () {
        return $this->hasMany(PagosVenta::class, 'IdPago', 'IdPago');
    }
}
