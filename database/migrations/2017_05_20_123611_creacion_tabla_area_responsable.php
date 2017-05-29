<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaAreaResponsable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_responsable', function (Blueprint $table) {
            $table->string('id', 255);
            $table->integer('incremento');
            $table->string('servidor_id', 4);

            $table->integer('area_responsable_id')->unsigned();
            $table->string('ingreso_id');
            $table->string('usuario_id');
            
            $table->primary('id');

            $table->foreign('area_responsable_id')->references('id')->on('catalogo_area_responsable');
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
        Schema::drop('area_responsable');
    }
}