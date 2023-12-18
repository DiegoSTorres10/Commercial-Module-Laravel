<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros_movimientos', function (Blueprint $table) {
            $table->id('IdRegistro');
            $table->unsignedBigInteger('FolioMovimiento');
            $table->unsignedBigInteger('IdRazon');
            $table->foreign('IdRazon')->references('IdRazon')->on('razones');
            $table->date('FechaMovimiento');
            $table->unsignedBigInteger('IdInventario');
            $table->foreign('IdInventario')->references('IdInventario')->on('almacenes_productos')->onDelete('cascade');
            $table->unsignedBigInteger('Cantidad');
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
        Schema::dropIfExists('registros_movimientos');
    }
}
