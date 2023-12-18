<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposMoneda extends Model
{
    use HasFactory;

    protected $fillable = ['TipoMoneda'];

    protected $primaryKey = 'IdTipoMoneda';
    protected $keyType = 'string';


    public function productosProveedores (){
        return $this->hasMany('App\Models\ProductosProveedore', 'IdTipoMoneda', 'IdTipoMoneda');
    }
}
