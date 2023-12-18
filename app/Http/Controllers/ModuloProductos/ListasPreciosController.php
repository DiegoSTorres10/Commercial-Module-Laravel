<?php

namespace App\Http\Controllers\ModuloProductos;
use App\Http\Controllers\Controller;
use App\Models\ListasPrecio;
use App\Models\ProductosServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ListasPreciosController extends Controller
{
    public function store(Request $request){
        try {
            $nuevaLista = ListasPrecio::create([
                'NombreLista' => $request->NombreLista,
                'Porcentaje' => $request->Porcentaje,
            ]);
            $IdLista = $nuevaLista->IdLista;
            return response()->json(['message' => 'Datos guardados correctamente', 'IdLista' => $IdLista], 200);
        } catch  (\Exception $e) {
            return response()->json(['message' => 'Error al guardar los datos'], 500);
        }
    }


    public function showListasProductos (ProductosServicio $Producto){
        $ObjetoProductoProveedor = $Producto->proveedores()->wherePivot('ProveedorSeleccionado', 1)->first();

        $ListaPrecios = ListasPrecio::orderBy('Porcentaje', 'asc')
        ->paginate(10);
        return view('ModuloProductos.showListaProductos', compact('Producto', 'ListaPrecios', 'ObjetoProductoProveedor'));
    }

    public function updateListasProductos (ProductosServicio $Producto, Request $request){
        $request->validate([
            'NombreLista' => 'nullable|string|max:255',
            'Porcentaje' => 'nullable|numeric',
            
        ]);
    
        try{
            $Id_Lista = $request->listas[0];
            if ($Id_Lista == 0){
                $nuevaLista = ListasPrecio::create([
                    'NombreLista' => $request->NombreLista,
                    'Porcentaje' => $request->Porcentaje,
                ]);
                $Id_Lista = $nuevaLista->IdLista;
                $PrecioProducto =  $request->CostoProveedor * (1+$request->Porcentaje/100);
            }else{
                $ListaSelec = ListasPrecio::where('IdLista', $Id_Lista)->first();
                $PrecioProducto = $request->CostoProveedor * (1+$ListaSelec->Porcentaje/100);
            }

            $Producto->IdLista = $Id_Lista;
            $Producto->Precio = $PrecioProducto;
            $Producto->save();
            Log::info("Se ha actualizado la lista de precio para el producto con clave: ", [$Producto->ClaveProducto]);
            session::flash('update_lista', 'Se ha actualizado la lista de precio para el producto con clave:' . $Producto->ClaveProducto);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('productosListas.showListasProductos', $Producto);

    }
}
