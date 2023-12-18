<?php

namespace Database\Seeders;

use App\Models\ProductosServicio;
use Illuminate\Database\Seeder;

class ProductosServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Producto = new ProductosServicio();
        $Producto->ClaveProducto = "SSD-280";
        $Producto->IdTipo =1;
        $Producto->Clasificador='Electronica';
        $Producto->UnidadMedida = "Pieza";
        $Producto->Nombre= "SSD SATA III";
        $Producto->Descripcion= "Marca Kigstone";
        $Producto->Precio= 280;
        $Producto->IdLista = 1;
        $Producto->save();
        $Producto->proveedores()->attach('SSD-280', ['ClaveProducto'=> 'SSD-280', 'IdProveedor'=> 1, 'CostoProveedor'=> 250, 'IdTipoMoneda'=> 'MXN' ,'FechaCotizacion'=> '2023-11-01', 'ProveedorSeleccionado'=> 1]);



        $Producto = new ProductosServicio();
        $Producto->ClaveProducto = "USB-480GB";
        $Producto->IdTipo =1;
        $Producto->Clasificador='Electronica';
        $Producto->UnidadMedida = "Pieza";
        $Producto->Nombre= "Memoria USB de 480 gb";
        $Producto->Precio= 500;
        $Producto->IdLista = 2;
        $Producto->save();
        $Producto->proveedores()->attach('USB-480GB', ['ClaveProducto'=> 'USB-480GB', 'IdProveedor'=> 2, 'CostoProveedor'=> 480, 'IdTipoMoneda'=> 'MXN' ,'FechaCotizacion'=> '2023-11-01', 'ProveedorSeleccionado'=> 1]);


        $products = array(
            array(
                "ClaveProducto" => "HDD-500",
                "IdTipo" => 1,
                "Clasificador" => "Electronica",
                "UnidadMedida" => "Pieza",
                "Nombre" => "Disco Duro",
                "Descripcion" => "Marca XYZ",
                "Precio" => 120,
                "IdLista" => 1
            ),
            array(
                "ClaveProducto" => "MNT-24",
                "IdTipo" => 1,
                "Clasificador" => "Electronica",
                "UnidadMedida" => "Pieza",
                "Nombre" => "Monitor",
                "Descripcion" => "Marca ABC",
                "Precio" => 300,
                "IdLista" => 1
            ),
            array(
                "ClaveProducto" => "PRN-001",
                "IdTipo" => 1,
                "Clasificador" => "Electronica",
                "UnidadMedida" => "Pieza",
                "Nombre" => "Impresora",
                "Descripcion" => "Marca XYZ",
                "Precio" => 150,
                "IdLista" => 1
            ),
            array(
                "ClaveProducto" => "KBRD-001",
                "IdTipo" => 1,
                "Clasificador" => "Electronica",
                "UnidadMedida" => "Pieza",
                "Nombre" => "Teclado",
                "Descripcion" => "Marca ABC",
                "Precio" => 30,
                "IdLista" => 1
            ),
            array(
                "ClaveProducto" => "USB-128",
                "IdTipo" => 1,
                "Clasificador" => "Electronica",
                "UnidadMedida" => "Pieza",
                "Nombre" => "USB Drive",
                "Descripcion" => "Marca XYZ",
                "Precio" => 20,
                "IdLista" => 1
            )
        );
        
        
        foreach ($products as $product) {
            $Producto = new ProductosServicio();
            $Producto->ClaveProducto = $product["ClaveProducto"];
            $Producto->IdTipo = $product["IdTipo"];
            $Producto->Clasificador = $product["Clasificador"];
            $Producto->UnidadMedida = $product["UnidadMedida"];
            $Producto->Nombre = $product["Nombre"];
            $Producto->Descripcion = $product["Descripcion"];
            $Producto->Precio = $product["Precio"];
            $Producto->IdLista = $product["IdLista"];
            $Producto->save();
            $Producto->proveedores()->attach($product["ClaveProducto"], [
                'ClaveProducto' => $product["ClaveProducto"],
                'IdProveedor' => 1,
                'CostoProveedor' => 250,
                'IdTipoMoneda' => 'MXN',
                'FechaCotizacion' => '2023-11-01',
                'ProveedorSeleccionado' => 1
            ]);
        }
        
    }
}
