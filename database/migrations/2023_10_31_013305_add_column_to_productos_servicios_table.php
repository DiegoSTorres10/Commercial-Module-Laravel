<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToProductosServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos_servicios', function (Blueprint $table) {
            $table->unsignedBigInteger('IdLista')->nullable()->after('Precio');
            $table->foreign('IdLista')->references('IdLista')->on('listas_precios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos_servicios', function (Blueprint $table) {
            $table->dropForeign('productos_servicios_idlista_foreign');
            $table->dropColumn('IdLista');
        });
    }
}
