<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductosProveedore extends Model
{
    use HasFactory;
    protected $fillable = ['ClaveProducto', 'IdProveedor', 'CostoProveedor', 'IdTipoMoneda', 'FechaCotizacion', 'ProveedorSeleccionado'];

    protected $primaryKey = 'IdProductosProveedores';


    
    public function tiposMoneda (){
        return $this->belongsTo('App\Models\TiposMonedas', 'IdTipoMoneda', 'IdTipoMoneda');
    }


   
}
