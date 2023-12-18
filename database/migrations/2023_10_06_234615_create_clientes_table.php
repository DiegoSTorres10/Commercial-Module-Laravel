<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('IdCliente');
            $table->date('FechaAlta');
            $table->string('RFC', 14);
            $table->string('CURP', 18)->nullable();
            $table->string('NombreCompleto', 255);
            $table->string('Email', 255)->unique()->nullable();
            $table->string('ClaveTipo', 10)->nullable();
            $table->foreign('ClaveTipo')
                ->references('ClaveTipo')
                ->on('tipo_clientes')
                ->onDelete('set null');

            $table->string('Calle', 255)->nullable();
            $table->string('NoExterior', 255)->nullable();
            $table->string('Nointerior', 255)->nullable();
            $table->string('Colonia', 255)->nullable();
            $table->string('Municipio', 255)->nullable();
            $table->string('Estado', 255)->nullable();
            $table->string('ClavePais', 10)->nullable();
            $table->foreign('ClavePais')
                ->references('ClavePais')
                ->on('paises')
                ->onDelete('set null');
            $table->boolean('Estatus')->default(true);

            $table->string('CP', 20);
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
        Schema::dropIfExists('clientes');
    }
}
