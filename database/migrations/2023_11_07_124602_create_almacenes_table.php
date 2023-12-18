<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacenes', function (Blueprint $table) {
            $table->id('IdAlmacen');
            $table->string("NombreAlmacen");
            $table->text("DescripcionAlmacen")->nullable();
            $table->string('NumeroTelefonico', 20);
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

            $table->string('CP', 20)->nullable();
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
        Schema::dropIfExists('almacenes');
    }
}
