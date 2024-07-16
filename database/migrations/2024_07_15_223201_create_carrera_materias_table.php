<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarreraMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrera_materias', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('nivel_id');
            $table->string('materia_sigla');
            $table->string('carrera_sigla');

            
             // Foreign Keys
            $table->foreign('nivel_id')->references('id')->on('niveles');
            $table->foreign('materia_sigla')->references('sigla')->on('materias');
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
        Schema::dropIfExists('carrera_materias');
    }
}
