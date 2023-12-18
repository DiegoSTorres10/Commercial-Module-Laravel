<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosFacturacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_facturaciones', function (Blueprint $table) {
            $table->id('IdFacturacion');
            $table->string('NombreCompleto', 255);

            $table->string('Calle', 255);
            $table->string('NoExterior', 255);
            $table->string('Nointerior', 255)->nullable();
            $table->string('Colonia', 255);
            $table->string('Municipio', 255);
            $table->string('Estado', 255);
            $table->string('ClavePais', 10)->nullable();
            $table->foreign('ClavePais')
                ->references('ClavePais')
                ->on('paises')
                ->onDelete('set null');

            $table->string('CP', 20);

            $table->unsignedBigInteger('IdCliente');
            $table->foreign('IdCliente')
                ->references('IdCliente')
                ->on('clientes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('datos_facturaciones');
    }
}
