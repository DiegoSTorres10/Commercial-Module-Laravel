<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;
    protected $fillable = [
        'IdTelefono',
        'NumeroTelefonico',
        'IdCliente',
    ];

    protected $primaryKey = 'IdTelefono';
    

    //Relacion de Uno a muchos para los metodos de paises
    public function clientes (){
        return $this->belongsTo('App\Models\Cliente', 'IdCliente', 'IdCliente');
    }


}
