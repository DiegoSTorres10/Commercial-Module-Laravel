<?php

namespace App\Http\Controllers\ModuloCliente;

use App\Http\Controllers\Controller;
use App\Models\Almacene;
use App\Models\AlmacenesProducto;
use App\Models\CajasVenta;
use App\Models\Cliente;
use App\Models\DetallesVenta;
use App\Models\PagosVenta;
use App\Models\ProductosServicio;
use App\Models\TiposPago;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDF;





class VentasController extends Controller
{
    public function index (){
        $Almacenes = Almacene::where('Estatus', 1)->get();
        return view ('ModuloClientes.Ventas.index', compact('Almacenes'));
    }

    public function create (Request $request){
        $request->validate([
            'Almacen' => 'required|numeric|min:1',
            'Fecha' => 'required|date' 
        ]);
        $Almacen = Almacene::where('IdAlmacen', $request->Almacen)->first();
        $NombreAlmacen = $Almacen->NombreAlmacen;
        $IdAlmacen = $request->Almacen;
        $Fecha = $request->Fecha;
        $FolioVenta = Venta::max('IdVenta')+1;
        $user = Auth::user();
        $Clientes = Cliente::orderBy('NombreCompleto', 'asc')->get();
        $MetodoPagos = TiposPago::all();
        return view ('ModuloClientes.Ventas.create', compact('NombreAlmacen', 'IdAlmacen', 'Fecha', 'FolioVenta', 'user', 'Clientes', 'MetodoPagos'));
    }

    public function store (Request $request){
        $validator = Validator::make($request->all(), [
            'FechaVenta' => ['required', 'date'],
            'IdAlmacen' => ['required', 'numeric'],
            'IdCliente' => ['nullable', 'numeric', 'min:1'],
            'MetodoPago' => ['required'],
            'NombreElaborador' => ['required'],
            'DescuentoTotal' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        try{

            DB::beginTransaction();

            $CajasExiste = CajasVenta::where('IdAlmacen', $request->IdAlmacen)->where('Fecha', $request->FechaVenta)->first();
            if ($CajasExiste){
                $IdCaja = $CajasExiste->IdCaja;
            }else{
                $NewCaja = new CajasVenta();
                $NewCaja->IdAlmacen = $request->IdAlmacen;
                $NewCaja->Fecha = $request->FechaVenta;
                $NewCaja->save();
                $IdCaja= $NewCaja->IdCaja;
            }
            

            $NewVenta = new Venta();
            $NewVenta->IdCaja = $IdCaja;
            $NewVenta->FechaHora = Carbon::now() ;
            $NewVenta->IdCliente = $request->IdCliente ;
            $NewVenta->NombreElaborador = $request->NombreElaborador ;
            $NewVenta->Descuento = $request->Descuento ;
            $NewVenta->TotalPagar = $request->DescuentoTotal;
            $NewVenta->save();

            for ($i = 0; $i < count($request->Clave); $i++) {
                $NewDetallesCompra = new DetallesVenta();
                $NewDetallesCompra->IdVenta = $NewVenta->IdVenta ;
                $NewDetallesCompra->ClaveProducto =$request->Clave[$i] ;
                $NewDetallesCompra->CantidadProductos = $request->Cantidad[$i] ;
                $Producto = ProductosServicio::where('ClaveProducto', $request->Clave[$i])->first();
                $SubTotal = $Producto->Precio * $request->Cantidad[$i];

                $Inventario = AlmacenesProducto::where('IdAlmacen', $request->IdAlmacen)
                ->where('ClaveProducto', $request->Clave[$i])->first();
                if (!$Inventario || $Inventario->CantidadProductos < $request->Cantidad[$i]) {
                    throw new \Exception('Existencias insuficientes para el producto con clave ' . $request->Clave[$i]);
                }
                $Inventario->CantidadProductos -= $request->Cantidad[$i];
                $Inventario->save();


                $NewDetallesCompra->Subtotal = $SubTotal ;
                $NewDetallesCompra->save();
            }

            $NewTipoPago = new PagosVenta();
            $NewTipoPago-> IdTipoPago = $request->MetodoPago ;
            $NewTipoPago-> IdVenta =  $NewVenta->IdVenta ;
            if ($request->DescuentoTotal <= $request->Monto)
                $NewTipoPago-> Monto = $request->DescuentoTotal;
            else
                $NewTipoPago-> Monto = $request->Monto;
            $NewTipoPago->save();
            DB::commit();
            return response()->json(['message' => 'Se ha realizado correctamente la venta', 'IdVenta' => $NewVenta->IdVenta], 200);
            $AlmacenSearch = Almacene::where('IdAlmacen', $request->IdAlmacen)->first();
            Log::info("Se ha creado la venta del almacen ", [$AlmacenSearch->NombreAlmacen]);

        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['errors' => ['Error en '.$e]], 500);
        }

        
        return $request;
    }


    public function pdfVenta (Request $request, $IdVenta=null){
            if ($IdVenta == null)
                $IdVenta = $request->IdVenta;
            $Venta = Venta::where('IdVenta', $IdVenta)->first();
            if ($Venta->Clientes && $Venta->Clientes->NombreCompleto){
                $NombreArchivo = 'Venta-'. $Venta->Clientes->NombreCompleto. '-Fecha-'. $Venta->FechaHora;
            }else{
                $NombreArchivo = 'Venta-Fecha-'. $Venta->FechaHora;
            }


            
            $pdf = PDF::loadView('ModuloClientes/Ventas/Reporte-Ventas', compact('Venta'));
            $pdf->setPaper('letter', 'portrait');
            return $pdf->stream($NombreArchivo);
    }
}
