<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RegistrosMovimiento extends Model
{
    use HasFactory;


    protected $fillable = [
        'FolioMovimiento','IdRazon', 'FechaMovimiento', 'IdInventario', 'Cantidad'
    ];


    protected $primaryKey = 'IdRegistro';

    public function razones  (){
        return $this->belongsTo('App\Models\Razone', 'IdRazon', 'IdRazon');
    }

    public function inventario  (){
        return $this->belongsTo('App\Models\AlmacenesProducto', 'IdInventario', 'IdInventario');
    }
}
