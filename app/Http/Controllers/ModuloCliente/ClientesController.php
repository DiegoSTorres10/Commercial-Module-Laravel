<?php

namespace App\Http\Controllers\ModuloCliente;


use App\Models\Cliente;
use App\Models\DatosEntrega;
use App\Models\DatosFacturacione;
use App\Models\Paise;
use App\Models\Telefono;
use App\Models\TipoCliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ClientesController extends Controller
{
    public function index (){
        return view('ModuloClientes/Clientes/index');
    }

    public function create (){
        $TipoClientes = TipoCliente::all();
        $Paises = Paise::orderBy('Pais', 'asc')->get();
        $ultimoCliente = Cliente::latest('IdCliente')->first();
        $ultimoCliente = $ultimoCliente ? $ultimoCliente->IdCliente + 1 : 1;
        return view('ModuloClientes/Clientes/create', compact('TipoClientes', 'Paises', 'ultimoCliente'));
    }

    public function store(Request $request){
        $request->validate([
            'RFC' => 'required|string|min:13|max: 14',
            'CURP' => 'nullable|string|min:18|max:18',
            'NombreCompleto' => 'required|string|max:255',
            'TipoCliente'=> 'required',
            'Calle' => 'nullable | string |max:255',
            'NoExterior' => 'nullable|max:255',
            'Colonia' => 'nullable| string |max:255',
            'Municipio'=> 'nullable| string |max:255',
            'Estado'=>'nullable| string |max:255',
            'Pais' => 'nullable',
            'CP' => 'nullable | max:20',
            'tel1' => 'required | max:15',
            'tel2' => 'nullable | min:5 |  max:15',
            'Email' => 'nullable|unique:clientes| email',
            'NombreCompletoFacturacion' => 'required | string |max:255',
            'CalleFacturacion' => 'required | string |max:255',
            'NoExteriorFacturacion' => 'required | max:255',
            'ColoniaFactura' => 'required | string |max:255',
            'MunicipioFactura' => 'required | string |max:255',
            'EstadoFactura' => 'required | string |max:255',
            'PaisFactura' => 'required',
            'CPFactura' => 'required | max:20',
            'NombreCompletoEntrega' => 'required | string |max:255',
            'CalleEntrega' => 'required | string |max:255',
            'NoExteriorEntrega' =>'required |max:255',
            'ColoniaEntrega' => 'required | string |max:255',
            'MunicipioEntrega' => 'required | string |max:255',
            'EstadoEntrega' => 'required | string |max:255',
            'PaisEntrega' => 'required',
            'CPEntrega' => 'required | max:20',
        ]);

        try{
            $Cliente = new Cliente();
            $Cliente->FechaAlta = $request->FechaAlta;
            $Cliente->RFC = $request->RFC;
            $Cliente->CURP = $request->CURP;
            $Cliente->NombreCompleto = $request->NombreCompleto;
            $Cliente->ClaveTipo = $request->TipoCliente;
            $Cliente->Calle = $request->Calle;
            $Cliente->NoExterior = $request->NoExterior;
            $Cliente->NoInterior = $request->NoInterior;
            $Cliente->Colonia = $request->Colonia;
            $Cliente->Municipio = $request->Municipio;
            $Cliente->Estado = $request->Estado;
            $Cliente->ClavePais = $request->Pais;
            $Cliente->Email = $request->Email;
            $Cliente->CP = $request->CP;


            if ($Cliente->save()){
                $IdCliente = $Cliente->IdCliente;
                $tel = new Telefono();
                $tel->IdCliente = $IdCliente;
                $tel->NumeroTelefonico = $request->tel1;
                if ($tel->save()){
                    if ( $request->tel2 != null ){
                        $tel2 = new Telefono();
                        $tel2->IdCliente = $IdCliente;
                        $tel2->NumeroTelefonico = $request->tel2;
                        $tel2->save();
                    }
                }
                Log::info("Se ha dado del alta los datos del cliente", ['NombreCompleto' => $request->NombreCompleto]);
                
                $DatosFactura = new DatosFacturacione();
                $DatosFactura->NombreCompleto = $request->NombreCompletoFacturacion;
                $DatosFactura->Calle = $request->CalleFacturacion;
                $DatosFactura->NoExterior = $request->NoExteriorFacturacion;
                $DatosFactura->NoInterior = $request->NoInteriorFacturacion;
                $DatosFactura->Colonia = $request->ColoniaFactura;
                $DatosFactura->Municipio = $request->MunicipioFactura;
                $DatosFactura->Estado = $request->EstadoFactura;
                $DatosFactura->ClavePais = $request->PaisFactura;
                $DatosFactura->CP = $request->CPFactura;
                $DatosFactura->IdCliente = $IdCliente;
                
                if ($DatosFactura->save())
                    Log::info("Se ha dado del alta la direccion de facturación del cliente", ['NombreCompleto' => $request->NombreCompleto]);

                $DatosEntrega = new DatosEntrega();
                $DatosEntrega->NombreCompleto = $request->NombreCompletoEntrega;
                $DatosEntrega->Calle = $request->CalleEntrega;
                $DatosEntrega->NoExterior = $request->NoExteriorEntrega;
                $DatosEntrega->NoInterior = $request->NoInteriorEntrega;
                $DatosEntrega->Colonia = $request->ColoniaEntrega;
                $DatosEntrega->Municipio = $request->MunicipioEntrega;
                $DatosEntrega->Estado = $request->EstadoEntrega;
                $DatosEntrega->ClavePais = $request->PaisEntrega;
                $DatosEntrega->CP = $request->CPEntrega;
                $DatosEntrega->Referencias = $request->Referencias;
                $DatosEntrega->IdCliente = $IdCliente;

                if ($DatosEntrega->save()){
                    Log::info("Se ha dado del alta la direccion de entrega del cliente", ['NombreCompleto' => $request->NombreCompleto]);
                }
                    
                
                
                session::flash('create_Cliente', 'Se ha creado con éxito el cliente: '. $request->NombreCompleto);
                return redirect()->route('clientes.index');
            }
            
            
        } catch (\Exception $e) {
            // Almacenar el mensaje de error en la sesión
            session()->flash('error', $e->getMessage());

            // Redireccionar al usuario a una página de error
            return redirect()->route('clientes.index');
        }
    }


    public function show (Cliente $clientes){
        $TipoClientes = TipoCliente::all();
        $Paises = Paise::orderBy('Pais', 'asc')->get();
        return view('ModuloClientes/Clientes/show', compact('clientes', 'TipoClientes', 'Paises'));
    }

    public function update(Cliente $cliente, Request $request){

        $request->validate([
            'RFC' => 'required|string|min:13|max: 14',
            'CURP' => 'nullable|string|min:18|max:18',
            'NombreCompleto' => 'required|string|max:255',
            'TipoCliente'=> 'required',
            'Calle' => 'required | string |max:255',
            'NoExterior' => 'required|max:255',
            'Colonia' => 'required| string |max:255',
            'Municipio'=> 'required| string |max:255',
            'Estado'=>'required| string |max:255',
            'Pais' => 'required',
            'CP' => 'required | max:20',
            'tel1' => 'required | max:15',
            'tel2' => 'nullable | min:5 |  max:15',
            'Email' => 'required| email',
        ]);

        $NombreCliente = $cliente->NombreCompleto;
        $cliente->RFC = $request->RFC;
        $cliente->CURP = $request->CURP;
        $cliente->NombreCompleto = $request->NombreCompleto;
        $cliente->ClaveTipo = $request->TipoCliente;
        $cliente->Calle = $request->Calle;
        $cliente->NoExterior = $request->NoExterior;
        $cliente->NoInterior = $request->NoInterior;
        $cliente->Colonia = $request->Colonia;
        $cliente->Municipio = $request->Municipio;
        $cliente->Estado = $request->Estado;
        $cliente->ClavePais = $request->Pais;
        $cliente->Email = $request->Email;
        $cliente->save();

        $tel1 = Telefono::where('IdCliente', $cliente->IdCliente)->first();
        $tel1->IdCliente = $cliente->IdCliente;
        $tel1->NumeroTelefonico = $request->tel1;
        $tel1->save();

        

        if (Telefono::where('IdCliente', $cliente->IdCliente)->count() < 2) {
            $tel2 = new Telefono();
            $tel2->IdCliente = $cliente->IdCliente;
            $tel2->NumeroTelefonico = $request->input('tel2');
            $tel2->save();
        }else{
            $tel2 = Telefono::where('IdCliente', $cliente->IdCliente)->skip(1)->first();
            if ($request->tel2 == ''){
                $tel2->delete();
            }else{
                $tel2->IdCliente = $cliente->IdCliente;
                $tel2->NumeroTelefonico = $request->tel2;
                $tel2->save();
            }
        }

        Log::info("Se ha modificado los datos del cliente", [$NombreCliente]);
        session::flash('update_Cliente', 'Los datos del cliente: ' . $NombreCliente." se ha actualizado con exito");
        return redirect()->route('clientes.index');
        

        


    }

    public function destroy (Cliente $cliente){
        $NombreCliente = $cliente->NombreCompleto;
        
        if (!$cliente->Ventas->isEmpty()) {
            $cliente->Estatus = false;

            $cliente->save();
        }else{
            $cliente->delete();
        }
        
        Log::info("Se ha eliminado los datos del cliente", [$NombreCliente]);
        session::flash('deleted_Cliente', 'Los datos del cliente: ' . $NombreCliente." se han eliminado con exito");
        return redirect()->route('clientes.index');
    }
    
}
