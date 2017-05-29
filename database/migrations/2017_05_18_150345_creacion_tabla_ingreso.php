<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaIngreso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso', function (Blueprint $table) {
            $table->string('id', 255);
            $table->integer('incremento');
            $table->string('servidor_id', 4);

            $table->string('pre_ingreso_id');
            $table->integer('registro_triage');
            $table->integer('estado_triage_id')->unsigned();
            $table->integer('grado_lesion_id')->unsigned();
            $table->integer('estatus_ingreso_id')->unsigned();
            $table->string('usuario_id');
            
            $table->primary('id');

            $table->foreign('pre_ingreso_id')->references('id')->on('pre_ingreso');
            $table->foreign('estado_triage_id')->references('id')->on('estado_triage');
            $table->foreign('grado_lesion_id')->references('id')->on('grado_lesion');
            
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
        Schema::drop('ingreso');
    }
}
