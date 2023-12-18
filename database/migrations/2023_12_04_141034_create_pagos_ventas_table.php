<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_ventas', function (Blueprint $table) {
            $table->id('IdPago');
            $table->unsignedBigInteger('IdVenta');
            $table->foreign('IdVenta')->references('IdVenta')->on('ventas');
            $table->unsignedBigInteger('IdTipoPago');
            $table->foreign('IdTipoPago')->references('IdTipoPago')->on('tipos_pagos');
            $table->decimal('Monto', 15,2);
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
        Schema::dropIfExists('pagos_ventas');
    }
}
