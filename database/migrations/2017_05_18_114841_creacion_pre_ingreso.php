<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionPreIngreso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_ingreso', function (Blueprint $table) {
            $table->string('id', 255);
            $table->integer('incremento');
            $table->string('servidor_id', 4);


            $table->string('paciente_id');
            $table->integer('referida');
            $table->string('unidad_referida');
            $table->string('urgencia_calificada');
            $table->integer('responsable');
            $table->primary('id');
            $table->string('usuario_id');
            
            $table->foreign('paciente_id')->references('id')->on('paciente');

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
        Schema::drop('pre_ingreso');
    }
}
