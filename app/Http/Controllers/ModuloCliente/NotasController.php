<?php

namespace App\Http\Controllers\ModuloCliente;

use App\Models\Cliente;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class NotasController extends Controller
{
    public function index (){
        $Notas = Nota::orderBy('FechaProximoSeguimiento')->paginate(5);
        $NotasCalendar = Nota::where('Estatus', 1)->get();

        $events = [];

        foreach ($NotasCalendar as $event) {
            $events[] = [
                'title' => '"'.$event->Tema.'"',
                'description' => $event->clientes->NombreCompleto,
                'start' => $event->FechaProximoSeguimiento,
                'end' => $event->FechaProximoSeguimiento,
                'color' => '#424242',
            ];
        }
        return view('ModuloClientes/Notas/index', compact('events', 'Notas'));
    }

    public function create (){
        $Clientes = Cliente::all();
        $ultimaNota = Nota::latest('IdNota')->first();
        $ultimaNota = $ultimaNota ? $ultimaNota->IdNota +1  : 1;
        $user = Auth::user();
        return view ('ModuloClientes/Notas/create',compact('Clientes', 'ultimaNota', 'user'));
    }

    

    public function store(Request $request){

        
        $request->validate([
            'Tema' => 'required|string|min:5|max: 255',
            'FechaProximoSeguimiento' => 'required|date',
            'Observaciones' => 'nullable|string',
            'IdCliente'=> 'required',
            'FechaCreacion' => 'required',
            'NombreElaborador' => 'required',
        ]);

        try{
            $NombreCompletoCLiente = Cliente::find($request->IdCliente);
            Nota::create($request->all());

            Log::info("Se ha dado del alta la nota para el cliente", [$NombreCompletoCLiente->NombreCompleto]);
            session::flash('create_nota', 'Se ha creado con éxito la nota del cliente: '.$NombreCompletoCLiente->NombreCompleto. "con el tema de la nota: ". $request->Tema);
        }catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            
        }
        return redirect()->route('notas.index');
        
    }

    public function show (Nota $Nota){

        return view ('ModuloClientes/Notas/show', compact('Nota'));
    }

    public function edit (Nota $Nota){
        return view ('ModuloClientes/Notas/edit', compact('Nota'));
    }

    public function update(Nota $Nota, Request $request){
        $request->validate([
            'Tema' => 'required|string|min:5|max: 255',
            'FechaProximoSeguimiento' => 'required|date',
            'Observaciones' => 'nullable|string',
        ]);

        $Nota->Tema = $request->Tema;
        $Nota->FechaProximoSeguimiento = $request->FechaProximoSeguimiento;
        $Nota->Observaciones = $request->Observaciones;
        if ($request->Estatus!=null)
            $Nota->Estatus=false;
        $Nota->save();
        Log::info("Se ha modificado la nota para el cliente", [$request->Contacto]);
        session::flash('update_nota', 'Se ha creado con éxito la nota del cliente: '.$request->Contacto. "con el tema de la nota: ". $request->Tema);
        return redirect()->route('notas.index');
    }

    public function destroy (Nota $Nota){
        
        Log::info("Se ha eliminado la nota para el cliente", [$Nota->clientes->NombreCompleto]);
        session::flash('delete_nota', 'Se ha eliminado con éxito la nota del cliente: "'.$Nota->clientes->NombreCompleto. '" con el tema de la nota: '. $Nota->Tema);
        $Nota->delete();
        return redirect()->route('notas.index');
    }

    public function DetallesCliente(Request $request){
        $Cliente = Cliente::find($request->IdCliente);
        return view ('ModuloClientes/Notas/DatosCliente', compact('Cliente'));
    }
}
