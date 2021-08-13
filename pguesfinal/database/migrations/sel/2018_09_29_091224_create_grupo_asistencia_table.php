<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoAsistenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_asistencia', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_asistencia');
            $table->time('hora_inicio');
            $table->time('hora_final');
            $table->integer('idgrupo')->unsigned();
            $table->foreign('idgrupo')->references('idgrupo')->on('grupos');
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
        Schema::drop('grupo_asistencia');
    }
}
