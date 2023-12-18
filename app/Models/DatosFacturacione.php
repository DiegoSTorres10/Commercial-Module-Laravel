<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DatosFacturacione extends Model
{
    use HasFactory;


    protected $fillable = ['IdFacturacion', 'NombreCompleto','Calle','NoExterior','Nointerior',
    'Colonia','Municipio','Estado','ClavePais','CP','IdCliente',
    ];

    protected $primaryKey = 'IdFacturacion';

    
    public function clientes (){
        return $this->belongsTo('App\Models\Cliente', 'IdCliente', 'IdCliente');
    }

}
