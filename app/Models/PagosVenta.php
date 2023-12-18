<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagosVenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'IdTipoPago','IdVenta', 'Monto'
    ];
    protected $primaryKey = 'IdPago';

    public function TipoPagos (){
        return $this->belongsTo(TiposPago::class, 'IdTipoPago', 'IdTipoPago');
    }

    public function Ventas (){
        return $this->belongsTo(Venta::class, 'IdVenta', 'IdVenta');
        
    }
}
