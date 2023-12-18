<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenesProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacenes_productos', function (Blueprint $table) {
            $table->id('IdInventario');
            $table->unsignedBigInteger('IdAlmacen');
            $table->foreign('IdAlmacen')->references('IdAlmacen')->on('almacenes');
            $table->string('ClaveProducto');
            $table->foreign('ClaveProducto')->references('ClaveProducto')->on('productos_servicios')->onDelete('cascade');
            $table->unsignedBigInteger('CantidadProductos');
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
        Schema::dropIfExists('almacenes_productos');
    }
}
