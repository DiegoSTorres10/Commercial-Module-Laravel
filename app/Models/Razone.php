<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Razone extends Model
{
    use HasFactory;


    protected $fillable = [
        'Razon','IdTipo'
    ];


    protected $primaryKey = 'IdRazon';

    public function tipos_movimientos (){
        return $this->belongsTo('App\Models\TipoMovimiento', 'IdTipo', 'IdTipo');
    }

    public function registros_movimientos(){
        return $this->hasMany('App\Models\RegistrosMovimiento','IdRazon', 'IdRazon');
    }
}
