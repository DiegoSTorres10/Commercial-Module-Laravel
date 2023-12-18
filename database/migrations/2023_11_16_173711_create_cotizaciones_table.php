<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id('IdCotizacion');
            $table->date ('FechaCotizacion');
            $table->string ('NombreElaborador', 250);
            $table->unsignedBigInteger('IdAlmacen');
            $table->foreign('IdAlmacen')->references('IdAlmacen')->on('almacenes')->onDelete('cascade');
            $table->unsignedBigInteger('IdCliente');
            $table->foreign('IdCliente')->references('IdCliente')->on('clientes')->onDelete('cascade');
            $table->date('FechaVencimiento');
            $table->decimal('Descuento', 5,2)->nullable();
            $table->decimal('TotalPagarSinDescuento', 15, 2);
            $table->decimal('TotalPagar', 15,2);
            $table->boolean('Estatus')->default(true);
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
        Schema::dropIfExists('cotizaciones');
    }
}
