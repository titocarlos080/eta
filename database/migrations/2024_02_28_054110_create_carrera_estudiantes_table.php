<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarreraEstudiantesTable extends Migration
{
    public function up()
    {
        Schema::create('carrera_estudiantes', function (Blueprint $table) {
            $table->id();//Esto solo estaba en lo de Tito
            $table->string('estudiante_ci');
            $table->string('carrera_sigla');
            $table->timestamps();//y obviamente esto, todo lo demas no estaba

            // Foreign key constraints
            $table->foreign('estudiante_ci')->references('ci')->on('estudiantes')->onDelete('cascade');
            $table->foreign('carrera_sigla')->references('sigla')->on('carreras')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carrera_estudiantes');
    }
}
