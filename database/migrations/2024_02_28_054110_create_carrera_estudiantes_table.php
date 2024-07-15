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
              $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('carrera_estudiantes');
    }
}
