<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_ventas', function (Blueprint $table) {
            $table->id('IdDetalle');
            $table->unsignedBigInteger('IdVenta');
            $table->foreign('IdVenta')->references('IdVenta')->on('ventas');
            $table->string('ClaveProducto');
            $table->foreign('ClaveProducto')->references('ClaveProducto')->on('productos_servicios');
            $table->unsignedBigInteger('CantidadProductos');
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
        Schema::dropIfExists('detalles_ventas');
    }
}
