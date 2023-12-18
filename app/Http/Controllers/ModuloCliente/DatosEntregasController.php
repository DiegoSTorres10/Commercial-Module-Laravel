<?php

namespace App\Http\Controllers\ModuloCliente;

use App\Models\Cliente;
use App\Models\DatosEntrega;
use App\Models\Paise;

use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DatosEntregasController extends Controller
{
    public function show (Request $request){
        $Paises = Paise::orderBy('Pais', 'asc')->get();
        $Datos = DatosEntrega::where('IdCliente', $request->IdCliente)->get();
        return view('ModuloClientes/DatosEntregas/show', compact('Datos', 'Paises'));
    }

    public function update($IdEntrega, Request $request){
        $Datos = DatosEntrega::findOrFail($IdEntrega);
        $Cli = Cliente::find($Datos->IdCliente);

        $request->validate([
            'NombreCompletoEntrega' => 'required|string|max:255',
            'CalleEntrega' => 'required | string |max:255',
            'NoExteriorEntrega' => 'required|max:255',
            'ColoniaEntrega' => 'required| string |max:255',
            'MunicipioEntrega'=> 'required| string |max:255',
            'EstadoEntrega'=>'required| string |max:255',
            'PaisEntrega' => 'required',
            'CPEntrega' => 'required | max:20',
        ]);



        $NombreCliente = $Datos->NombreCompleto;
        $Datos->NombreCompleto = $request->NombreCompletoEntrega;
        $Datos->Calle = $request->CalleEntrega;
        $Datos->NoExterior = $request->NoExteriorEntrega;
        $Datos->NoInterior = $request->NoInteriorEntrega;
        $Datos->Colonia = $request->ColoniaEntrega;
        $Datos->Municipio = $request->MunicipioEntrega;
        $Datos->Estado = $request->EstadoEntrega;
        $Datos->ClavePais = $request->PaisEntrega;
        $Datos->CP = $request->CPEntrega;
        $Datos->Referencias = $request->Referencias;
        $Datos->save();
        $Direccion = $Datos->Calle. " ".$Datos->Colonia." ".$Datos->Municipio. ", ".$Datos->Estado;

        

        Log::info("Se ha modificado los datos de entrega del cliente", [$NombreCliente], " con la dirección ", [$Direccion]);
        session::flash('update_DatosCliente_Entregas', 'Los datos del la entrega del cliente: ' . $NombreCliente." con la dirección en ".$Direccion. " se ha actualizado con exito");
        return redirect()->route('clientes.show', $Cli);
    }

}
