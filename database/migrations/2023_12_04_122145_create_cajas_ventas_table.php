<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajasVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas_ventas', function (Blueprint $table) {
            $table->id('IdCaja');
            $table->unsignedBigInteger('IdAlmacen');
            $table->foreign('IdAlmacen')->references('IdAlmacen')->on('almacenes');
            $table->date('Fecha');
            $table->decimal('DineroInicial', 15,2)->nullable();
            $table->decimal('DineroFinal', 15,2)->nullable();
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
        Schema::dropIfExists('cajas_ventas');
    }
}
