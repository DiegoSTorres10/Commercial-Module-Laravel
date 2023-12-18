<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paise extends Model
{
    use HasFactory;
    protected $fillable = [
        'ClavePais',
        'Pais',
    ];

    protected $primaryKey = 'ClavePais';
    protected $keyType = 'string';

    //RElacion uno a muchos
    public function clientes(){
        return $this->hasMany('App\Models\Cliente','IdCliente', 'IdCliente');
    }

    
    public function almacenes(){
        return $this->hasMany('App\Models\Almacene','IdAlmacen', 'IdAlmacen');
    }


    //RElacion uno a muchos
    public function datos_entrega(){
        return $this->hasMany('App\Models\DatosEntrega', 'IdEntrega');
    }

    //RElacion uno a muchos
    public function datos_facturacion(){
        return $this->hasMany('App\Models\DatosFacturacione', 'IdFacturacion');
    }


}
