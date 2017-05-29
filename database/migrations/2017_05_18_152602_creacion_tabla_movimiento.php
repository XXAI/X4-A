<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaMovimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traslado', function (Blueprint $table) {
            $table->string('id', 255);
            $table->integer('incremento');
            $table->string('servidor_id', 4);

            $table->string('ingreso_id');
            $table->string('area');
            $table->string('nota');
            $table->integer('estatus_traslado');
            
            $table->dateTime('fecha_hora');
            $table->string('usuario_id');
            
            $table->primary('id');
            $table->foreign('ingreso_id')->references('id')->on('ingreso');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('traslado');
    }
}
