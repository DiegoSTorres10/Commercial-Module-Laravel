<?php

namespace App\Http\Controllers\ModuloAlmacen;

use App\Http\Controllers\Controller;
use App\Models\Almacene;
use App\Models\AlmacenesProducto;
use App\Models\ProductosServicio;
use App\Models\Razone;
use App\Models\RegistrosMovimiento;
use App\Models\TipoMovimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;

class MovimientosController extends Controller
{
    public function movimientos()
    {
        $Almacenes = Almacene::where('Estatus', 1)->get();
        $Folio = RegistrosMovimiento::max('FolioMovimiento');

        if ($Folio == null)
            $Folio = 1;
        else
            $Folio = $Folio + 1;

        $TipoMovimiento = TipoMovimiento::all();
        $Productos = ProductosServicio::all();

        return view('ModuloAlmacen.Movimientos.index', compact('Almacenes', 'Folio', 'TipoMovimiento', 'Productos'));
    }

    public function consulta_razones(Request $request)
    {

        $Razones = Razone::where('IdTipo', $request->IdTipo)->get();
        return response()->json($Razones);
    }


    public function obtenerProductos()
    {
        $productos = ProductosServicio::where('Estatus', 1)->get();
        return response()->json($productos);
    }

    public function ObtenerDetallesProductos(Request $request)
    {
        $producto = ProductosServicio::where('ClaveProducto', $request->ClaveProducto)->get();
        return response()->json($producto);
    }



    public function obtenerProductosAlmacen(Request $request)
    {
        $productos = Almacene::where('IdAlmacen', $request->Almacen)

            ->first()
            ->productos()
            ->wherePivot('CantidadProductos', '>', 0)
            ->get();
        return response()->json($productos);
    }

    public function ObtenerDetallesProductosAlmacen(Request $request)
    {
        $producto = ProductosServicio::where('productos_servicios.ClaveProducto', $request->ClaveProducto)
            ->with(['almacenes' => function ($query) use ($request) {
                $query->where('almacenes_productos.IdAlmacen', $request->IdAlmacen);
            }])
            ->get();
        $nombre = $producto[0]->Nombre;
        $unidadMedida = $producto[0]->UnidadMedida;
        $existencias = $producto[0]->almacenes[0]->pivot->CantidadProductos;
        $costo = $producto[0]->Precio;
        $data = [
            'Nombre' => $nombre,
            'UnidadMedida' => $unidadMedida,
            'Existencias' => $existencias,
            'Precio' => $costo
        ];
        return response()->json($data);
    }


    public function ReporteMovimiento($IdFolio)
    {
        $Historial = RegistrosMovimiento::where('FolioMovimiento', $IdFolio)->first();
        $inventario = $Historial->inventario;
        $almacenProducto = Almacene::where('IdAlmacen', $inventario->IdAlmacen)->first();
        $NombreAlmacen = $almacenProducto->NombreAlmacen;
        $resultados = DB::table('registros_movimientos')
            ->join('almacenes_productos', 'registros_movimientos.IdInventario', '=', 'almacenes_productos.IdInventario')
            ->join('productos_servicios', 'almacenes_productos.ClaveProducto', '=', 'productos_servicios.ClaveProducto')
            ->where('registros_movimientos.FolioMovimiento',  $IdFolio)
            ->select(
                'registros_movimientos.*',
                'almacenes_productos.*',
                'productos_servicios.*'
            )
            ->get();
        $fechaHoy = Carbon::now()->format('Y-m-d');

        $nombreArchivo = 'Movimiento-' . $Historial->razones->tipos_movimientos->TipoMovimiento . '-' . $Historial->razones->Razon . '-' . $almacenProducto->NombreAlmacen . '-' . $fechaHoy . '.pdf';
        $pdf = PDF::loadView(' ModuloAlmacen.Movimientos.reporte-Movimientos', compact('Historial', 'NombreAlmacen', 'resultados'));
        $pdf->setPaper('letter', 'portrait');
        return $pdf->stream($nombreArchivo);
    }


    public function store(Request $request)
    {

        $Almacen = $request->Almacen;
        $NombreAlmacen = Almacene::where('IdAlmacen', $Almacen)->first();
        $NoFolio = $request->Folio;
        $FechaMovimiento = $request->FechaMovimiento;
        $Tipo = $request->Tipo;
        $Razon = $request->Razon;

        if ($Tipo == 'Ent') {
            try {
                for ($i = 0; $i < count($request->Clave); $i++) {
                    $ClaveProducto = $request->Clave[$i];
                    $Cantidad = $request->Cantidad[$i];
                    $Costo = $request->Costo[$i];
                    $Prod = ProductosServicio::where('ClaveProducto', $ClaveProducto)->first();
                    $Prod->update(['Precio' => $Costo]);
                    $productoAlmacen = $Prod->almacenes()->wherePivot('IdAlmacen', $Almacen)->first();
                    if ($productoAlmacen == null) {
                        $Prod->almacenes()->attach($ClaveProducto, ['IdAlmacen' => $Almacen, 'ClaveProducto' => $ClaveProducto, 'CantidadProductos' => $Cantidad]);
                        $Id_Inventario = $Prod->almacenes()->wherePivot('IdAlmacen', $Almacen)->first()->pivot->IdInventario;
                        $NewRegistroMOvimiento = new RegistrosMovimiento();
                        $NewRegistroMOvimiento->FolioMovimiento = $NoFolio;
                        $NewRegistroMOvimiento->IdRazon = $Razon;
                        $NewRegistroMOvimiento->IdInventario = $Id_Inventario;
                        $NewRegistroMOvimiento->FechaMovimiento = $FechaMovimiento;
                        $NewRegistroMOvimiento->Cantidad = $Cantidad;
                        $NewRegistroMOvimiento->save();
                    } else {
                        $Id_Inventario = $Prod->almacenes()->wherePivot('IdAlmacen', $Almacen)->first()->pivot->IdInventario;
                        $cantidadActual = $Prod->almacenes()->wherePivot('IdAlmacen', $Almacen)->first()->pivot->CantidadProductos;
                        $nuevaCantidad = $cantidadActual + $Cantidad;
                        $NewRegistroMOvimiento = new RegistrosMovimiento();
                        $NewRegistroMOvimiento->FolioMovimiento = $NoFolio;
                        $NewRegistroMOvimiento->IdRazon = $Razon;
                        $NewRegistroMOvimiento->IdInventario = $Id_Inventario;
                        $NewRegistroMOvimiento->FechaMovimiento = $FechaMovimiento;
                        $NewRegistroMOvimiento->Cantidad = $Cantidad;
                        $NewRegistroMOvimiento->save();
                        $Prod->almacenes()->wherePivot('IdAlmacen', $Almacen)->update(['CantidadProductos' => $nuevaCantidad]);
                    }
                }

                Log::info("Se ha dado del alta los productos en el almacen: ", [$NombreAlmacen->NombreAlmacen]);
                session::flash('update_almacen', 'Se ha dado del alta los productos en el almacen:  ' . $NombreAlmacen->NombreAlmacen);
            } catch (\Exception $e) {
                session()->flash('error', $e->getMessage());
            }
        } else {
            try {
                for ($i = 0; $i < count($request->Clave); $i++) {
                    $ClaveProducto = $request->Clave[$i];
                    $Cantidad = $request->Cantidad[$i];
                    $Prod = ProductosServicio::where('ClaveProducto', $ClaveProducto)->first();
                    $productoAlmacen = $Prod->almacenes()->wherePivot('IdAlmacen', $Almacen)->first();
                    $Id_Inventario = $Prod->almacenes()->wherePivot('IdAlmacen', $Almacen)->first()->pivot->IdInventario;
                    $cantidadActual = $Prod->almacenes()->wherePivot('IdAlmacen', $Almacen)->first()->pivot->CantidadProductos;
                    $nuevaCantidad = $cantidadActual - $Cantidad;
                    $NewRegistroMOvimiento = new RegistrosMovimiento();
                    $NewRegistroMOvimiento->FolioMovimiento = $NoFolio;
                    $NewRegistroMOvimiento->IdRazon = $Razon;
                    $NewRegistroMOvimiento->IdInventario = $Id_Inventario;
                    $NewRegistroMOvimiento->FechaMovimiento = $FechaMovimiento;
                    $NewRegistroMOvimiento->Cantidad = $Cantidad;
                    $NewRegistroMOvimiento->save();
                    $Prod->almacenes()->wherePivot('IdAlmacen', $Almacen)->update(['CantidadProductos' => $nuevaCantidad]);
                }

                Log::info("Se ha eliminado las cantidades de los productos en el almacén: ", [$NombreAlmacen->NombreAlmacen]);
                session::flash('delete_almacen', 'Se ha eliminado las cantidades de los productos en el almacén:  ' . $NombreAlmacen->NombreAlmacen);
            } catch (\Exception $e) {
                session()->flash('error', $e->getMessage());
            }
        }

        // return redirect()->route('movimientos.ReporteMovimiento', $NoFolio);

        $urlPdf = route('movimientos.ReporteMovimiento', $NoFolio);

        // Almacena la URL del PDF en una variable de sesión
        session()->put('url_pdf', $urlPdf);
        return redirect()->route('movimientos.index');
    }
}
