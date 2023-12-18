<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_proveedores', function (Blueprint $table) {
            $table->id('IdProductosProveedores');
            $table->string('ClaveProducto', 255);
            $table->foreign('ClaveProducto')->references('ClaveProducto')->on('productos_servicios')->onDelete('cascade');
            $table->unsignedBigInteger('IdProveedor');
            $table->foreign('IdProveedor')->references('IdProveedor')->on('proveedores')->onDelete('cascade');
            $table->decimal('CostoProveedor', 20, 2);
            $table->string('IdTipoMoneda', 10)->nullable();
            $table->foreign('IdTipoMoneda')->references('IdTipoMoneda')->on('tipos_monedas')->onDelete('set null');
            $table->date('FechaCotizacion');
            $table->boolean('ProveedorSeleccionado');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos_proveedores');
    }
}
