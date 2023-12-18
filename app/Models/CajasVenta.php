<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajasVenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'IdAlmacen','Fecha', 'DineroInicial', 'DineroFinal',
    ];
    protected $primaryKey = 'IdCaja';

    public function Ventas() {
        return $this->hasMany(Venta::class, 'IdVenta', 'IdVenta');
    }

    public function Almacenes (){
        return $this->belongsTo(Almacene::class,'IdAlmacen','IdAlmacen');
    }
}
