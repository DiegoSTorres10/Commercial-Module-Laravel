<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion_productos', function (Blueprint $table) {
            $table->id('IdCotiProdu');
            $table->string('ClaveProducto', 255);
            $table->foreign('ClaveProducto')->references('ClaveProducto')->on('productos_servicios')->onDelete('cascade');
            $table->unsignedInteger('CantidadProductos');
            $table->unsignedBigInteger('IdCotizacion');
            $table->foreign('IdCotizacion')->references('IdCotizacion')->on('cotizaciones')->onDelete('cascade');
            $table->decimal('Subtotal', 15,2);
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
        Schema::dropIfExists('cotizacion_productos');
    }
}
