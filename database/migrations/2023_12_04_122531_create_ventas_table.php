<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('IdVenta');
            $table->unsignedBigInteger('IdCliente')->nullable();
            $table->foreign('IdCliente')->references('IdCliente')->on('clientes');
            $table->dateTime('FechaHora');
            $table->unsignedBigInteger('IdCaja');
            $table->foreign('IdCaja')->references('IdCaja')->on('cajas_ventas');
            $table->string ('NombreElaborador', 250);
            $table->decimal('Descuento', 10,2);
            $table->decimal('TotalPagar', 15,2);

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
        Schema::dropIfExists('ventas');
    }
}
