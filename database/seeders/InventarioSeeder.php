<?php

namespace Database\Seeders;


use App\Models\ProductosServicio;
use App\Models\RegistrosMovimiento;
use Illuminate\Database\Seeder;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $folioMovimiento = 1;
        $Productos = ProductosServicio::all();
        foreach ($Productos as $producto){
            for ($IdAlmacen=1; $IdAlmacen<4; $IdAlmacen++){
                $cantidadProductos = rand(1, 10000);
                $producto->almacenes()->attach($producto->ClaveProducto, ['CantidadProductos' => $cantidadProductos, 'ClaveProducto'=>$producto->ClaveProducto, 'IdAlmacen'=> $IdAlmacen]);
                $DatosInventario = $producto->almacenes()->wherePivot('ClaveProducto', $producto->ClaveProducto)
                ->wherePivot('IdAlmacen',$IdAlmacen)->first();
                $idInventario = $DatosInventario->pivot->IdInventario;
                $razonId = 1;
                $fechaMovimiento = now();
                RegistrosMovimiento::create([
                        'FolioMovimiento' => $folioMovimiento++,
                        'IdRazon' => $razonId,
                        'FechaMovimiento' => $fechaMovimiento,
                        'IdInventario' => $idInventario,
                        'Cantidad' => $cantidadProductos,
                    ]);
            }
            
        }
    }
}
