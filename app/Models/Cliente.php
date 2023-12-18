<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{

    use HasFactory;

    protected $fillable = [
        'IdCliente','FechaAlta', 'RFC', 'CURP', 'NombreCompleto', 'Email', 'ClaveTipo', 'Calle',
        'NoExterior', 'Nointerior', 'Colonia', 'Municipio', 'Estado', 'ClavePais',
        'CP',
    ];

    protected $primaryKey = 'IdCliente';

    // ========== belongsto =================

    //Relacion de Uno a muchos para los metodos de TipoClientes
    public function tipo_clientes (){
        return $this->belongsTo('App\Models\TipoCliente', 'ClaveTipo', 'ClaveTipo');
    }

    public function notas (){
        return $this->hasMany('App\Models\Nota', 'IdCliente', 'IdCliente');
    }

    
    public function paises (){
        return $this->belongsTo('App\Models\Paise', 'ClavePais', 'ClavePais');
    }


    //   =========Uno a uno ======================
    //Relacion para la direccion de facturacion
    public function datos_facturacion (){
        return $this->hasOne('App\Models\DatosFacturacione', 'IdCliente', 'IdCliente');
    }


    // ============Uno a muchos =============
    //Relacion para los telefonos
    public function telefonos(){
        return $this->hasMany('App\Models\Telefono', 'IdCliente', 'IdCliente');
    }

    public function datos_entrega(){
        return $this->hasMany('App\Models\DatosEntrega', 'IdCliente', 'IdCliente');
    }


    public function Cotizaciones (){
        return $this->hasMany(Cotizacione::class, 'IdCliente', 'IdCliente');
    }

    public function Ventas (){
        return $this->hasMany(Venta::class, 'IdCliente', 'IdCliente');
    }



}
