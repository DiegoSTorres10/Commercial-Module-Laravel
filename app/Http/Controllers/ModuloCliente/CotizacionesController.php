<?php

namespace App\Http\Controllers\ModuloCliente;

use App\Http\Controllers\Controller;
use App\Models\Almacene;
use App\Models\Cliente;
use App\Models\Cotizacione;
use App\Models\CotizacionProductos;
use App\Models\ProductosServicio;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class CotizacionesController extends Controller
{
    public function index()
    {
        return view('ModuloClientes.Cotizaciones.index');
    }

    public function create()
    {
        $Almacenes = Almacene::orderBy('IdAlmacen', 'asc')->get();
        $ultimoFolio = Cotizacione::max('IdCotizacion');
        $Folio = $ultimoFolio + 1;
        $user = Auth::user();
        $Clientes = Cliente::orderBy('NombreCompleto', 'asc')->get();
        return view('ModuloClientes.Cotizaciones.create', compact('Almacenes', 'Folio', 'user', 'Clientes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'IdAlmacen' => ['required'],
            'FechaCotizacion' => ['required', 'date'],
            'NombreElaborador' => ['required', 'string'],
            'IdCliente' => ['required'],
            'FechaCotizacion' => ['required', 'date'],
            'Descuento' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        


        try {
            DB::beginTransaction();
            $Cotizacion = new Cotizacione();
            $Cotizacion->FechaCotizacion = $request->FechaCotizacion;
            $Cotizacion->NombreElaborador = $request->NombreElaborador;
            $Cotizacion->IdAlmacen = $request->IdAlmacen;
            $Cotizacion->IdCliente = $request->IdCliente;

            $fechaOriginal = $request->FechaCotizacion;
            $dateTime = new DateTime($fechaOriginal);
            $dateTime->modify('+5 days');
            $nuevaFecha = $dateTime->format('Y-m-d');


            $Cotizacion->FechaVencimiento = $nuevaFecha;
            $Cotizacion->Descuento = $request->Descuento;
            $Cotizacion->TotalPagarSinDescuento = $request->TotalCompra;
            $Cotizacion->TotalPagar = $request->DescuentoTotal;
            $Cotizacion->save();

            $IdCotizacion = $Cotizacion->IdCotizacion;


            for ($i = 0; $i < count($request->Clave); $i++) {
                $DetallesCotizacion = new CotizacionProductos();
                $DetallesCotizacion->IdCotizacion = $IdCotizacion;
                $DetallesCotizacion->ClaveProducto = $request->Clave[$i];
                $DetallesCotizacion->CantidadProductos = $request->Cantidad[$i];
                $Producto = ProductosServicio::where('ClaveProducto', $request->Clave[$i])->first();
                $SubTotal = $Producto->Precio * $request->Cantidad[$i];
                $DetallesCotizacion->Subtotal = $SubTotal ;
                $DetallesCotizacion->save();
            }

            DB::commit();
            return response()->json(['message' => 'Cotización creada correctamente', 'IdCotizacion' => $IdCotizacion], 200);
            $NombreCliente = $Cotizacion->Clientes->NombreCompleto;
            Log::info("Se ha creado la cotizacion del cliente ", [$NombreCliente]);
            
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['errors' => ['Error en '.$e]], 500);
        }


        // return response()->json(['errors' => ["No se puede escoger un proveedor que ya halla sido seleccionado"]], 422);
    }

    public function pdfCotizacion(Request $request, $IdCotizacion=null){
        if ($IdCotizacion == null)
            $IdCotizacion = $request->IdCotizacion;
        $Cotizacion = Cotizacione::where('IdCotizacion', $IdCotizacion)->first();
        $NombreArchivo = 'Cotizacion-'. $Cotizacion->Clientes->NombreCompleto. '-Fecha-'. $Cotizacion->FechaCotizacion;
        $pdf = PDF::loadView('ModuloClientes/Cotizaciones/Reporte-Cotizacion', compact('Cotizacion'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream($NombreArchivo);
    }

    public function destroy(Cotizacione $Cotizacion){
        $NombreCliente = $Cotizacion->Clientes->NombreCompleto;
        $FechaCotizacion = $Cotizacion->FechaCotizacion;
        $Cotizacion->delete();
        Log::info("Se ha eliminado la cotizacion del cliente ", [$NombreCliente]);
        session::flash('deleted_Cotizacion', 'Se ha eliminado la cotización del cliente: ' . $NombreCliente . " de la fecha: ". $FechaCotizacion);
        return redirect()->route('cotizaciones.index');
    }
}
