<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarreraEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrera_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inscripcion');
            $table->string('estudiante_ci', 20);
            $table->string('carrera_sigla', 255);
            $table->foreign('estudiante_ci')->references('ci')->on('estudiantes');
            $table->foreign('carrera_sigla')->references('sigla')->on('carreras');
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
        Schema::dropIfExists('carrera_estudiantes');
    }
}
