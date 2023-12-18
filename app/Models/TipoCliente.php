<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoCliente extends Model
{
    use HasFactory;


    protected $fillable = [
        'ClaveTipo',
        'Descripcion',
    ];

    protected $primaryKey = 'ClaveTipo';
    protected $keyType = 'string';


    //RElacion uno a muchos
    public function clientes(){
        return $this->hasMany('App\Models\Cliente');
    }

}
