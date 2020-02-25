<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero');
            $table->string('tipo');
            $table->date('fecha');
            $table->float('ingreso');
            $table->float('egreso');
            $table->float('ingreso_acumulado');
            $table->float('egreso_acumulado');
            $table->string('persona');
            $table->string('detalle');
            $table->string('telefono');
            $table->bigInteger('usuario_id');
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
        Schema::dropIfExists('recibos');
    }
}
