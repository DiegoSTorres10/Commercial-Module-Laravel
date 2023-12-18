<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['Tema', 'NombreElaborador', 'IdCliente', 'FechaProximoSeguimiento', 'FechaCreacion', 'Estatus', 'Observaciones'];

    protected $primaryKey = 'IdNota';


    public function clientes (){
        return $this->belongsTo('App\Models\Cliente', 'IdCliente', 'IdCliente');
    }
}
