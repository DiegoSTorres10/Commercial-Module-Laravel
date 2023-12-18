<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccesoModulo extends Model
{
    use HasFactory;
    protected $fillable = [
        'IdModulo',
        'NombreModulo',
    ];

    protected $primaryKey = 'IdModulo';


    public function users(){
        return $this->belongsToMany('App\Models\Users', 'acceso_user', 'IdModulo','IdUsuario');
    }
}
