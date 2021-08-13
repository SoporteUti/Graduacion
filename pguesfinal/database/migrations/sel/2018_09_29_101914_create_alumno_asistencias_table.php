<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnoAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_asistencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grupo_asistencia_id')->unsigned();
            $table->integer('idestudiante')->unsigned();
            $table->boolean('asistencia');
            $table->foreign('idestudiante')->references('idestudiante')->on('estudiantes');
            $table->foreign('grupo_asistencia_id')->references('id')->on('grupo_asistencia');
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
        Schema::drop('alumno_asistencias');
    }
}
