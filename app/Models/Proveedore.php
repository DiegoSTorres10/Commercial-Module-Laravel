<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedore extends Model
{
    
    use HasFactory;

    protected $fillable = ['NombreComercial', 'GrupoEmpresarial', 'Telefono', 'CorreoElectronico'];

    protected $primaryKey = 'IdProveedor';

     // Si queremos acceder a los elementos de la tabla pivote, debemos colocarlos con el metodo
    // withPivot() y adentro los atributos que queremos acceder. Posteriormente en la vista, 
    // accedes a funcion + ->pivot->" Elemetno"
    public function productos_servicios (){
        return $this->belongsToMany('App\Models\ProductosServicio', 'productos_proveedores','IdProveedor', 'ClaveProducto')
        ->withPivot('CostoProveedor', 'IdTipoMoneda', 'FechaCotizacion', 'ProveedorSeleccionado');
    }
}
