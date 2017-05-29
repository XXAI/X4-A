<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionTablaResponsable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsable', function (Blueprint $table) {
            $table->string('id', 255);
            $table->integer('incremento');
            $table->string('servidor_id', 4);

            $table->string('ingreso_id');
            $table->string('nombre');
            $table->string('parentesco');
            $table->string('domicilio');

            $table->string('telefono');
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
        Schema::drop('responsable');
    }
}
