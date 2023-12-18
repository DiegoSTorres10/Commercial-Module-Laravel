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
Use PDF;



class ProductosServiciosController extends Controller
{
    public function index (){

        return view ('ModuloProductos.index');
    }

    public function create(){
        $TipoProd = TipoProdServicio::all();
        $Proveedores = Proveedore::all();
        $TiposMoneda = TiposMoneda::all();
        return view ('ModuloProductos.create', compact('TipoProd', 'Proveedores', 'TiposMoneda'));
    }

    public function createListas(Request $request){
        $Produc = json_decode($request->input('producto'), true);

        $ListaPrecios = ListasPrecio::orderBy('Porcentaje', 'asc')
        ->paginate(10);
        return view('ModuloProductos.createListas', compact('ListaPrecios', 'Produc'));
    }

    public function CalcularPrecioProducto ($PrecioProveedor, $IdLista){
        $ListaPrecio = ListasPrecio::where('IdLista', $IdLista)->first();
        return ($PrecioProveedor * (1+($ListaPrecio->Porcentaje/100)));
    }

    public function store(Request $request){
        $producto = $request->input('Producto');

        $validator = Validator::make($producto, [
            'ClaveProducto' => ['required','string', 'max: 255','unique:productos_servicios,ClaveProducto'],
            'IdTipo' => ['required'],
            'Clasificador' => ['required', 'max:255'],
            'UnidadMedida'  => ['required', 'max:255'],
            'Nombre'  => ['required', 'max:255'],
            'Descripcion' => ['nullable'],
            'IdProveedor' => ['required'],
            'IdTipoMoneda' => ['required'],
            'FechaCotizacion' => ['required', 'date'],
            'CostoProveedor' => ['required', 'numeric'],
            'IdLista' => ['required'],
        ], [
            'unique' => 'El producto con la clave proporcionada ya está registrado.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        try{
            $NuevoProducto = new ProductosServicio();
            $NuevoProducto->ClaveProducto = $producto['ClaveProducto']; 
            $NuevoProducto->IdTipo = $producto['IdTipo']; 
            $NuevoProducto->Clasificador = $producto['Clasificador']; 
            $NuevoProducto->UnidadMedida = $producto['UnidadMedida']; 
            $NuevoProducto->Nombre = $producto['Nombre']; 
            $NuevoProducto->Descripcion = $producto['Descripcion'];
            
            
            $NuevoProducto->Precio =  $this->CalcularPrecioProducto($producto['CostoProveedor'], $producto['IdLista']); ;
            $NuevoProducto->IdLista = $producto['IdLista']; 
            $NuevoProducto->save();

            $NuevoProducto->proveedores()->attach($producto['ClaveProducto'], ['ClaveProducto'=> $producto['ClaveProducto'], 'IdProveedor'=> $producto['IdProveedor'], 'CostoProveedor'=> $producto['CostoProveedor'], 'IdTipoMoneda'=> $producto['IdTipoMoneda'] ,'FechaCotizacion'=> $producto['FechaCotizacion'], 'ProveedorSeleccionado'=> 1]);


            
        }catch (\Exception $e){
            return response()->json(['errors' => $e], 500);
        }

        
        return response()->json(['data' => $request->all()]);
    }


    public function show (ProductosServicio $Producto){
        return view('ModuloProductos.show', compact('Producto'));
    }

    public function edit (ProductosServicio $Producto){
        $TipoProd = TipoProdServicio::all();
        return view('ModuloProductos.edit', compact('Producto', 'TipoProd'));
    }

    public function updateDatosProducto (ProductosServicio $Producto, Request $request){
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'ClaveProducto' => 'required|string|max:255',
            'IdTipo' => 'required',
            'Clasificador' => 'required|string|max:255',
            'UnidadMedida' => 'required|string|max:255',
            'Descripcion' => 'nullable|string',
        ]);

        try{
            $Producto->Nombre = $request->Nombre;
            $Producto->IdTipo = $request->IdTipo;
            $Producto->Clasificador = $request->Clasificador;
            $Producto->UnidadMedida = $request->UnidadMedida;
            $Producto->Descripcion = $request->Descripcion;
            $Producto->save();


            Log::info("Se ha actualizado la información del producto con clave: ", [$request->ClaveProducto]);
            session::flash('update_Producto', 'Se ha actualizado la información del producto con clave: '.$request->ClaveProducto);
        }catch (\Exception $e){
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('productos.index');
    }

    public function destroy (ProductosServicio $Producto){
        try{
            $Clave = $Producto->ClaveProducto;
            if (!$Producto->almacenes->isEmpty() || !$Producto->productos_cotizaciones->isEmpty() || !$Producto->productos_venta->isEmpty()) {
                $Producto->Estatus = false;
                $Producto->save();
            }else{
                $Producto->delete();
            }
            

            Log::info("Se ha elimnado el producto con clave: ", [$Clave]);
            session::flash('delete_Producto', 'Se ha eliminado el producto con clave: '.$Clave);
        }catch (\Exception $e){
            session()->flash('error', $e->getMessage());
        }

        return redirect()->route('productos.index');
    }

    public function reporte()
    {
        $Productos = ProductosServicio::orderBy('ClaveProducto', 'asc')->get();

        $pdf = PDF::loadView(' ModuloProductos.reporte', compact('Productos'));
        return $pdf->stream('reporte_ProductosServicios.pdf');
    }

}

