<?php

namespace App\Http\Controllers\ModuloCliente;

use App\Models\Cliente;
use App\Models\DatosFacturacione;
use App\Models\Paise;

use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DatosFacturacionController extends Controller
{
    
    public function show (Request $request){

        $Paises = Paise::orderBy('Pais', 'asc')->get();
        $Datos = DatosFacturacione::where('IdCliente', $request->IdCliente)->first();
        return view('ModuloClientes/DatosFacturacion/show', compact('Datos', 'Paises'));
    }

    public function update (DatosFacturacione $Datos, Request $request){
        $request->validate([
            'NombreCompletoFacturacion' => 'required|string|max:255',
            'CalleFacturacion' => 'required | string |max:255',
            'NoExteriorFacturacion' => 'required|max:255',
            'ColoniaFactura' => 'required| string |max:255',
            'MunicipioFactura'=> 'required| string |max:255',
            'EstadoFactura'=>'required| string |max:255',
            'PaisFactura' => 'required',
            'CPFactura' => 'required | max:20',
        ]);



        $NombreCliente = $Datos->NombreCompleto;
        $Datos->NombreCompleto = $request->NombreCompletoFacturacion;
        $Datos->Calle = $request->CalleFacturacion;
        $Datos->NoExterior = $request->NoExteriorFacturacion;
        $Datos->NoInterior = $request->NoInteriorFacturacion;
        $Datos->Colonia = $request->ColoniaFactura;
        $Datos->Municipio = $request->MunicipioFactura;
        $Datos->Estado = $request->EstadoFactura;
        $Datos->ClavePais = $request->Pais;
        $Datos->CP = $request->CPFactura;
        $Datos->save();

        $Cli = Cliente::find($Datos->IdCliente);

        Log::info("Se ha modificado los datos de facturación del cliente", [$NombreCliente]);
        session::flash('update_DatosCliente', 'Los datos del la facturación del cliente: ' . $NombreCliente." se ha actualizado con exito");
        return redirect()->route('clientes.show', $Cli);
    }
}
