<?php

namespace App\Http\Controllers\ModuloProveedor;

use App\Http\Controllers\Controller;
use App\Models\Proveedore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ProveedorController extends Controller
{
    public function index (){
        
        return view('ModuloProveedores.index');
    }

    public function create(){
        return view ('ModuloProveedores.create');
    }

    public function store(Request $request){

        
        $request->validate([
            'NombreComercial' => 'required|string|min:1|max: 255',
            'GrupoEmpresarial' => 'required|string|max: 255',
            'Telefono' => 'required|string|max:20',
            'CorreoElectronico' => 'nullable|email|max:255',
        ]);

        try{
            
            Proveedore::create($request->all());

            Log::info("Se ha dado del alta el proveedor: ", [$request->NombreComercial]);
            session::flash('create_proveedor', 'Se ha dado del alta el proveedor: '. $request->NombreComercial);
        }catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            
        }
        return redirect()->route('proveedores.index');
        
    }

    public function edit (Proveedore $Proveedor){
        
        return view ('ModuloProveedores.edit', compact('Proveedor'));
    }

    public function update (Proveedore $Proveedor, Request $request){
        $request->validate([
            'NombreComercial' => 'required|string|min:1|max: 255',
            'GrupoEmpresarial' => 'required|string|max: 255',
            'Telefono' => 'required|string|max:20',
            'CorreoElectronico' => 'nullable|email|max:255',
        ]);

        try{
            $Proveedor->update($request->all());
            Log::info("Se ha actualizado el proveedor: ", [$request->NombreComercial]);
            session::flash('update_proveedor', 'Se ha actualizado el proveedor: '. $request->NombreComercial);
        }catch (\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        return redirect()->route('proveedores.index');
    }

    public function destroy (Proveedore $Proveedor){
        try{
            $nombre = $Proveedor->NombreComercial;
            $Proveedor->delete();
            Log::info("Se ha eliminado el proveedor: ", [$nombre]);
            session::flash('delete_proveedor', 'Se ha eliminado el proveedor: '. $nombre);
        }catch (\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        return redirect()->route('proveedores.index');
    }
}
