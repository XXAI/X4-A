<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaEgreso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egreso', function (Blueprint $table) {
            $table->string('id', 255);
            $table->integer('incremento');
            $table->string('servidor_id', 4);

            $table->string('ingreso_id');
            $table->integer('motivo_egreso_id')->unsigned();

            $table->dateTime('fecha_hora');
            $table->integer('contrareferencia');
            $table->string('unidad_referencia');
            $table->string('usuario_id');
            
            $table->primary('id');
            
            $table->foreign('ingreso_id')->references('id')->on('ingreso');
            $table->foreign('motivo_egreso_id')->references('id')->on('motivo_egreso');

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
        Schema::drop('egreso');
    }
}
