<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_servicios', function (Blueprint $table) {
            $table->string('ClaveProducto')->primary();
            $table->unsignedBigInteger('IdTipo')-> nullable();
            $table->foreign('IdTipo')->references('IdTipo')->on('tipo_prod_servicios')->onDelete('set null');
            $table->string('Clasificador', 255);
            $table->string('UnidadMedida', 255);
            $table->string('Nombre', 255);
            $table->text('Descripcion')->nullable();
            $table->decimal('Precio', 20, 2);
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
        Schema::dropIfExists('productos_servicios');
    }
}
