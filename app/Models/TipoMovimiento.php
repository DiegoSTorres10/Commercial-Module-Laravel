<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TipoMovimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'TipoMovimiento'
    ];


    protected $primaryKey = 'IdTipo';
    protected $keyType = 'string';

    public function razones(){
        return $this->hasMany('App\Models\Razone','IdRazon', 'IdRazon');
    }
}
