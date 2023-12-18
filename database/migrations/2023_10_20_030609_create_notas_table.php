<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id('IdNota');
            $table->string('Tema', 255);
            $table->string("NombreElaborador", 255);
            $table->unsignedBigInteger('IdCliente');
            $table->foreign('IdCliente')->references('IdCliente')->on('clientes')->onDelete('cascade');
            $table->date('FechaProximoSeguimiento');
            $table->date('FechaCreacion');
            $table->boolean('Estatus')->default(true);
            $table->text('Observaciones')->nullable();

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
        Schema::dropIfExists('notas');
    }
}
