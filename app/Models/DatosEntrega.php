<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DatosEntrega extends Model
{
    use HasFactory;


    protected $fillable = ['IdEntrega', 'NombreCompleto','Calle','NoExterior','Nointerior','Colonia',
        'Municipio','Estado','ClavePais','CP','IdCliente','Referencias',
    ];


    protected $primaryKey = 'IdEntrega';


    public function clientes (){
        return $this->belongsTo('App\Models\Cliente', 'IdCliente', 'IdCliente');
    }

    
}
