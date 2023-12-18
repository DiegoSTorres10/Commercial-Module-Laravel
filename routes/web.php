<?php

use App\Http\Controllers\ModuloAlmacen\AlmaceneContoller;
use App\Http\Controllers\ModuloAlmacen\AlmacenesController;
use App\Http\Controllers\ModuloAlmacen\ConsultaInventarioController;
use App\Http\Controllers\ModuloAlmacen\Movimientos;
use App\Http\Controllers\ModuloAlmacen\MovimientosController;
use App\Http\Controllers\ModuloCliente\ClientesController;
use App\Http\Controllers\ModuloCliente\CotizacionesController;
use App\Http\Controllers\ModuloCliente\DatosEntregasController;
use App\Http\Controllers\ModuloCliente\DatosFacturacionController;
use App\Http\Controllers\ModuloCliente\ModuloClientesController;
use App\Http\Controllers\ModuloCliente\NotasController;
use App\Http\Controllers\ModuloCliente\VentasController;
use App\Http\Controllers\ModuloProductos\ListasPreciosController;
use App\Http\Controllers\ModuloProductos\ProductosProveedoresController;
use App\Http\Controllers\ModuloProductos\ProductosServiciosController;
use App\Http\Controllers\ModuloProveedor\ProveedorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//================ Modulo de los clientes ==========================
Route::middleware(['auth', 'accesoModulo:1'])->group(function () {
       

    Route::get('/ModuloClientes', [ModuloClientesController::class, 'Index'])->name('ModuloClientes.index');
    Route::get('/ModuloClientes/cliente/DatosFacturacion', [DatosFacturacionController::class, 'show'])->name('DatosFactura.show');
    Route::get('/ModuloClientes/cliente/DatosEntregas', [DatosEntregasController::class, 'show'])->name('DatosEntregas.show'); 
    Route::put('/ModuloClientes/cliente/DatosEntregas/{IdEntrega}', [DatosEntregasController::class, 'update'])->name('DatosEntregas.update');
    Route::put('/ModuloClientes/cliente/DatosFacturacion/{Datos}', [DatosFacturacionController::class, 'update'])->name('DatosFacturacion.update');


    Route::get('/ModuloClientes/clientes',[ ClientesController::class, 'index'])->name('clientes.index');
    Route::get('/ModuloClientes/cliente/create',[ ClientesController::class, 'create'])->name('clientes.create');
    Route::post('/ModuloClientes/clientes',[ ClientesController::class, 'store'])->name('clientes.store'); 
    Route::get('/ModuloClientes/cliente/{clientes}',[ ClientesController::class, 'show'])->name('clientes.show');
    Route::put('ModuloClientes/cliente/{cliente}', [ ClientesController::class, 'update'])->name('clientes.update');
    Route::delete('/ModuloClientes/cliente/{cliente}', [ ClientesController::class, 'destroy'])->name('clientes.destroy');
    


    Route::get('/ModuloClientes/notas', [NotasController::class, 'index'])->name('notas.index');
    Route::get('/ModuloClientes/notas/create',[ NotasController::class, 'create'])->name('notas.create');
    Route::get('/ModuloClientes/Notas', [NotasController::class, 'DetallesCliente'])->name('DetallesCliente');
    Route::post('/ModuloClientes/Notas', [NotasController::class, 'store'])->name('notas.store');
    Route::get('/ModuloClientes/Notas/{Nota}', [NotasController::class, 'show'])->name('notas.show');
    Route::get('/ModuloClientes/Notas/{Nota}/edit', [NotasController::class, 'edit'])->name('notas.edit');
    Route::put('/ModuloClientes/Notas/{Nota}', [NotasController::class, 'update'])->name('notas.update');
    Route::delete('/ModuloClientes/Notas/{Nota}', [ NotasController::class, 'destroy'])->name('notas.destroy');



    Route::get('/ModuloClientes/Cotizaciones', [CotizacionesController::class, 'index'])->name('cotizaciones.index');
    Route::get('/ModuloClientes/Cotizaciones/create', [CotizacionesController::class, 'create'])->name('cotizaciones.create');
    Route::post('/ModuloClientes/Cotizaciones/store', [CotizacionesController::class, 'store'])->name('cotizaciones.store');
    Route::get('/ModuloClientes/Cotizaciones/PDF-Cotizacion/{IdCotizacion?}', [CotizacionesController::class, 'pdfCotizacion'])->name('cotizaciones.pdfCotizacion');
    Route::delete('/ModuloClientes/Cotizaciones/{Cotizacion}', [CotizacionesController::class, 'destroy'])->name('cotizaciones.destroy');



    Route::get('/ModuloClientes/Ventas', [VentasController::class, 'index'])->name('ventas.index');
    Route::post('/ModuloClientes/Ventas/create', [VentasController::class, 'create'])->name('ventas.create');
    Route::post('/ModuloClientes/Ventas/store', [VentasController::class, 'store'])->name('ventas.store');
    Route::get('/ModuloClientes/Ventas/PDF-Venta/{IdVenta?}', [VentasController::class, 'pdfVenta'])->name('ventas.pdfVentas');






    
});


//========= Módulo de almacenes =================
Route::middleware(['auth', 'accesoModulo:2'])->group(function () {
    Route::get('/ModuloAlmacen/Index', [AlmaceneContoller::class, 'index'])->name('ModuloAlmacen.index');

    Route::get('/ModuloAlmacen/Almacenes', [AlmacenesController::class, 'index'])->name('almacenes.index');
    Route::get('/ModuloAlmacen/Almacenes/create', [AlmacenesController::class, 'create'])->name('almacenes.create');
    Route::post('/ModuloAlmacen/Almacenes/', [AlmacenesController::class, 'store'])->name('almacenes.store');
    Route::get('/ModuloAlmacen/Almacenes/{Almacen}/edit', [AlmacenesController::class, 'edit'])->name('almacenes.edit');
    Route::put('/ModuloAlmacen/Almacenes/{Almacen}', [AlmacenesController::class, 'update'])->name('almacenes.update');
    Route::get('/ModuloAlmacen/Almacenes/{Almacen}/show', [AlmacenesController::class, 'show'])->name('almacenes.show');
    Route::delete('/ModuloAlmacen/Almacenes/{Almacen}', [AlmacenesController::class, 'destroy'])->name('almacenes.destroy');


    Route::get('/ModuloAlmacen/Movimientos', [MovimientosController::class, 'movimientos'])->name('movimientos.index');
    Route::get('/ModuloAlmacen/Movimientos/consulta-razones', [MovimientosController::class, 'consulta_razones'])->name('movimientos.consulta_razones');
    Route::get('/ModuloAlmacen/Movimientos/consulta-productos', [MovimientosController::class, 'obtenerProductos'])->name('movimientos.obtenerProductos');
    Route::get('/ModuloAlmacen/Movimientos/consulta-productos-almacen', [MovimientosController::class, 'obtenerProductosAlmacen'])->name('movimientos.obtenerProductosAlmacen');
    Route::get('/ModuloAlmacen/Movimientos/ObtenerDetallesProductos', [MovimientosController::class, 'ObtenerDetallesProductos'])->name('movimientos.ObtenerDetallesProductos');
    Route::get('/ModuloAlmacen/Movimientos/ObtenerDetallesProductosAlmacen', [MovimientosController::class, 'ObtenerDetallesProductosAlmacen'])->name('movimientos.ObtenerDetallesProductosAlmacen');
    Route::post('/ModuloAlmacen/Movimientos/', [MovimientosController::class, 'store'])->name('movimientos.store');
    Route::get('/ModuloAlmacen/Reporte-Movimiento/{IdFolio}', [MovimientosController::class, 'ReporteMovimiento'])->name('movimientos.ReporteMovimiento');


    Route::get('/ModuloAlmacen/ConsultaInventario', [ConsultaInventarioController::class, 'consultaInventario'])->name('inventario.consulta');

    
});



// ================= Modulo de Proveedores ====================
Route::middleware(['auth', 'accesoModulo:3'])->group(function () {
    Route::get('/ModuloProveedores/Proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::get('/ModuloProveedores/Proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
    Route::post('/ModuloProveedores/Proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('/ModuloProveedores/Proveedores/{Proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
    Route::put('/ModuloProveedores/Proveedores/{Proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
    Route::delete('/ModuloProveedores/Proveedores/{Proveedor}', [ ProveedorController::class, 'destroy'])->name('proveedores.destroy');
});



//=============== Modulo de productos
Route::middleware(['auth', 'accesoModulo:4'])->group(function () {
    Route::get('/ModuloProductos/ProductosServicios', [ProductosServiciosController::class, 'index'])->name('productos.index');
    Route::get('/ModuloProductos/ProductosServicios/create', [ProductosServiciosController::class, 'create'])->name('productos.create');
    Route::get('/ModuloProductos/ProductosServicios/createLista', [ProductosServiciosController::class, 'createListas'])->name('productos.createListas');
    Route::post('/ModuloProductos/ProductosServicios/', [ProductosServiciosController::class, 'store'])->name('productos.store');
    Route::get('/ModuloProductos/ProductosServicios/show/{Producto}', [ProductosServiciosController::class, 'show'])->name('productos.show');
    Route::get('/ModuloProductos/ProductosServicios/{Producto}/edit', [ProductosServiciosController::class, 'edit'])->name('productos.edit');
    Route::put('/ModuloProductos/ProductosServicios/{Producto}', [ProductosServiciosController::class, 'updateDatosProducto'])->name('productos.updateDatosProducto');
    Route::delete('/ModuloProductos/ProductosServicios/{Producto}', [ ProductosServiciosController::class, 'destroy'])->name('productos.destroy');
    Route::get('/ModuloProductos/ProductosProveedores/{Producto}/edit', [ProductosProveedoresController::class, 'EditProveedor'])->name('productosProveedores.EditProveedor');
    Route::post('/ModuloProductos/ProductosProveedores/', [ProductosProveedoresController::class, 'store'])->name('productosProveedores.store');
    Route::put('/ModuloProductos/ProductosProveedores/{Producto}', [ProductosProveedoresController::class, 'updateProductoProveedor'])->name('productosProveedores.updateProductoProveedor');
    Route::delete('/ModuloProductos/ProductosProveedores/{Producto}/{Id_Proveedor}', [ ProductosProveedoresController::class, 'destroyProductoProveedor'])->name('productosProveedores.destroyProductoProveedor');
    Route::get('/ModuloProductos/ListasPreciosProducto/{Producto}/edit', [ListasPreciosController::class, 'showListasProductos'])->name('productosListas.showListasProductos');
    Route::put('/ModuloProductos/ListasPreciosProducto/{Producto}', [ListasPreciosController::class, 'updateListasProductos'])->name('productosListas.updateListasProductos');
    Route::get('/ModuloProductos/Reporte', [ProductosServiciosController::class, 'reporte'])->name('productos.reporte');
    
    
    Route::post('/ModuloProductos/ListasPrecios', [ListasPreciosController::class, 'store'])->name('lista.store');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
