<?php

namespace App\Http\Controllers\ModuloAlmacen;

use App\Http\Controllers\Controller;
use App\Models\Almacene;
use App\Models\Paise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AlmacenesController extends Controller
{
    public function index (){
        $Almacenes = Almacene::all();
        return view ('ModuloAlmacen.Almacenes.index', compact('Almacenes'));
    }

    public function create (){
        $Paises = Paise::orderBy('Pais', 'asc')->get();
        return view ('ModuloAlmacen.Almacenes.create', compact('Paises'));
    }

    public function store (Request $request){

        $request->validate([
            'NombreAlmacen' => 'required|string|max:255',
            'NumeroTelefonico' => 'required|max:20',
            'DescripcionAlmacen' => 'nullable',
            'Calle' => 'nullable | string |max:255',
            'NoExterior' => 'nullable|max:255',
            'Colonia' => 'nullable| string |max:255',
            'Municipio'=> 'nullable| string |max:255',
            'Estado'=>'nullable|string |max:255',
            'ClavePais' => 'nullable',
            'CP' => 'nullable | max:20',
        ]);

        try{
            Almacene::create($request->all());


            Log::info("Se ha dado del alta un nuevo almacen: ", [$request->NombreAlmacen]);
            session::flash('create_almacen', 'Se ha dado del alta un nuevo almacen: '. $request->NombreAlmacen);
        }catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            
        }
        return redirect()->route('almacenes.index');
        
    }

    public function edit (Almacene $Almacen){
        $Paises = Paise::orderBy('Pais', 'asc')->get();
        return view('ModuloAlmacen.Almacenes.edit', compact('Almacen', 'Paises'));
    }

    public function update (Almacene $Almacen, Request $request){

        $request->validate([
            'NombreAlmacen' => 'required|string|max:255',
            'NumeroTelefonico' => 'required|max:20',
            'DescripcionAlmacen' => 'nullable',
            'Calle' => 'nullable | string |max:255',
            'NoExterior' => 'nullable|max:255',
            'Colonia' => 'nullable| string |max:255',
            'Municipio'=> 'nullable| string |max:255',
            'Estado'=>'nullable|string |max:255',
            'ClavePais' => 'nullable',
            'CP' => 'nullable | max:20',
        ]);

        try{
            $Almacen->update($request->all());


            Log::info("Se ha modificado el almacen: ", [$request->NombreAlmacen]);
            session::flash('updated_almacen', 'Se ha modificado el almacen: '. $request->NombreAlmacen);
        }catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            
        }
        return redirect()->route('almacenes.index');
    }

    public function show (Almacene $Almacen){
        return view('ModuloAlmacen.Almacenes.show', compact('Almacen'));
    }

    public function destroy (Almacene $Almacen){
        try{
            $NombreAlmacen = $Almacen->NombreAlmacen;
            $Almacen->productos()->detach();
            if (!$Almacen->CajasVentas->isEmpty()){
                $Almacen->Estatus = 0;
                $Almacen->save();
            }else{

                $Almacen->delete();
            }
            Log::info("Se ha eliminado el almacen: ", [$NombreAlmacen]);
            session::flash('delete_almacen', 'Se ha eliminado el almacen: '. $NombreAlmacen);
        }catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            
        }
        return redirect()->route('almacenes.index');
    }
}
