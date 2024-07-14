<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarreraEstudiantesTable extends Migration
{
   
    public function up()
    {
        Schema::create('carrera_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carrera_id')->references('id')->on('carreras')->onDelete('cascade');
            $table->foreignId('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('carrera_estudiantes');
    }
}
