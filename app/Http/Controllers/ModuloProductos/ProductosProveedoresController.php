<?php

namespace App\Http\Controllers\ModuloProductos;

use App\Http\Controllers\Controller;
use App\Models\ListasPrecio;
use App\Models\ProductosServicio;
use App\Models\Proveedore;
use App\Models\TipoProdServicio;
use App\Models\TiposMoneda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class ProductosProveedoresController extends Controller
{
    public function EditProveedor(ProductosServicio $Producto)
    {
        $TipoProd = TipoProdServicio::all();
        $Proveedores = Proveedore::all();
        $TiposMoneda = TiposMoneda::all();
        return view('ModuloProductos.editProveedor', compact('Producto', 'TipoProd', 'Proveedores', 'TiposMoneda'));
    }

    function CalcularPrecioProducto($PrecioProveedor, $NuevoProducto)
    {
        $ListaPrecio = ListasPrecio::where('IdLista', $NuevoProducto->IdLista)->first();
        $PrecioAumento =$PrecioProveedor * (1 + ($ListaPrecio->Porcentaje / 100));
        $NuevoProducto->Precio =$PrecioAumento;
        $NuevoProducto->save();
    }

    function CambioEstatusSelectorProovedor ($ClaveProducto, $IdProveedor){
        $productos_proveedores = ProductosServicio::where('ClaveProducto', $ClaveProducto)->first()->proveedores();
        $productos_proveedores->update(['ProveedorSeleccionado' => false]);
        $productos_proveedores->wherePivot('IdProveedor', $IdProveedor)->update(['ProveedorSeleccionado' => true]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ClaveProducto' => ['required', 'string', 'max: 255'],
            'IdProveedor' => ['required'],
            'IdTipoMoneda' => ['required'],
            'FechaCotizacion' => ['required', 'date'],
            'CostoProveedor' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $NuevoProducto = ProductosServicio::where('ClaveProducto', $request->ClaveProducto)->first();
        if ($NuevoProducto->proveedores()->wherePivot('ClaveProducto', $request->ClaveProducto)->wherePivot('IdProveedor', $request->IdProveedor)->exists()) {
            return response()->json(['errors' => ["No se puede escoger un proveedor que ya halla sido seleccionado"]], 422);
        }

        try{
            $NuevoProducto->proveedores()->attach($request->ClaveProducto, ['ClaveProducto' => $request->ClaveProducto, 'IdProveedor' => $request->IdProveedor, 'CostoProveedor' => $request->CostoProveedor, 'IdTipoMoneda' => $request->IdTipoMoneda, 'FechaCotizacion' => $request->FechaCotizacion, 'ProveedorSeleccionado' => $request->valorSeleccionado]);

            if ($request->valorSeleccionado == 1) {
                $this->CalcularPrecioProducto($request->CostoProveedor, $NuevoProducto);
                $this->CambioEstatusSelectorProovedor($request->ClaveProducto, $request->IdProveedor);
                Log::info("Se ha agregado un nuevo distribuidor para el producto con clave: ", [$request->ClaveProducto]);
            }
        }catch (\Exception $e){
            return response()->json(['errors' => $e], 500);
        }
    }

    public function updateProductoProveedor (Request $request, ProductosServicio $Producto){

        $request->validate([
            'FechaCotizacionRegister_'.$request->IdProveedorRegister => 'date|required',
            'IdProveedorRegister' => 'required|numeric',
            'CostoProveedor_'.$request->IdProveedorRegister => 'required|numeric',
            'IdTipoMoneda_'.$request->IdProveedorRegister => 'required',
        ],[
            'FechaCotizacionRegister_'.$request->IdProveedorRegister.'.date'=> 'El campo Fecha Cotización no corresponde con una fecha válida,',
            'CostoProveedorBueno_'.$request->IdProveedorRegister.'.required' => 'El campo Costo Proveedor es obligatorio.'

        ]);

        
        
        try{
            $productos_proveedores = ProductosServicio::where('ClaveProducto', $Producto->ClaveProducto)->first()->proveedores();
            $productos_proveedores->wherePivot('IdProveedor', $request->IdProveedorRegister)->update(['CostoProveedor'=> $request->input('CostoProveedor_' . $request->input('IdProveedorRegister')), 
                                'IdTipoMoneda'=> $request->input('IdTipoMoneda_' . $request->input('IdProveedorRegister')), 
                                'FechaCotizacion'=> $request->input('FechaCotizacionRegister_' . $request->input('IdProveedorRegister'))]);

            if ($request->SeleccionadoRegister == 1){
                $this->CalcularPrecioProducto($request->input('CostoProveedor_' . $request->input('IdProveedorRegister')), $Producto);
                $this->CambioEstatusSelectorProovedor($Producto->ClaveProducto, $request->IdProveedorRegister);
            }else{
                $ProductoProvedoresPivote = $productos_proveedores->wherePivot('IdProveedor', $request->IdProveedorRegister)->first();
                if ($ProductoProvedoresPivote->pivot->ProveedorSeleccionado == 1){
                    $this->CalcularPrecioProducto($request->input('CostoProveedor_' . $request->input('IdProveedorRegister')), $Producto);

                }
            }
            
            Log::info("Se ha actualizado el distribuidor para el producto con clave: ", [$Producto->ClaveProducto]);
            session::flash('update_Proveedor', 'Se ha actualizado el distribuidor: '.$request->input('ProveedorRegister_' . $request->input('IdProveedorRegister')). " con el producto con clave: ". $Producto->ClaveProducto);
        }catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('productosProveedores.EditProveedor', $Producto);

        
    }

    public function destroyProductoProveedor(ProductosServicio $Producto, $Id_Proveedor){
        try{
            $NombreProveedor = Proveedore::where('IdProveedor', $Id_Proveedor)->first();
            $Producto->proveedores()->wherePivot('IdProveedor', $Id_Proveedor)->detach();
            Log::info("Se ha eliminado el distribuidor para el producto con clave: ", [$Producto->ClaveProducto]);
            session::flash('delete_Proveedor', 'Se ha eliminado el distribuidor: '.$NombreProveedor->NombreComercial. " con el producto con clave: ". $Producto->ClaveProducto);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('productosProveedores.EditProveedor', $Producto);
    }
}
