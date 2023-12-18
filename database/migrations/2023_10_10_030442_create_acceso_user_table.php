<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acceso_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('IdModulo');
            $table->unsignedBigInteger('IdUsuario');
            $table->foreign('IdModulo')
                ->references('IdModulo')
                ->on('acceso_modulos')
                ->onDelete('cascade');
            $table->foreign('IdUsuario')
                ->references('IdUsuario')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('acceso_user');
    }
}
