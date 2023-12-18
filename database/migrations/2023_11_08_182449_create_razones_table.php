<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRazonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razones', function (Blueprint $table) {
            $table->id('IdRazon');
            $table->string('Razon', 255);
            $table->string('IdTipo', 3);
            $table->foreign('IdTipo')->references('IdTipo')->on('tipo_movimientos');
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
        Schema::dropIfExists('razones');
    }
}
