<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProdServicio extends Model
{
    use HasFactory;

    protected $fillable = ['Tipo'];

    protected $primaryKey = 'IdTipo';

    public function productosServicios (){
        return $this->hasMany('App\Models\ProductosServicio', 'IdTipo', 'IdTipo');
    }
}
