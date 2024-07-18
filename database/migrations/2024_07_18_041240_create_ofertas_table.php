<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gestion_codigo');
            $table->string('carrera_sigla');
            $table->string('materia_sigla');
            $table->string('grupo_sigla');
            $table->string('docente_ci');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('gestion_codigo')->references('codigo')->on('gestiones');
            $table->foreign('carrera_sigla')->references('sigla')->on('carreras');
            $table->foreign('materia_sigla')->references('sigla')->on('materias');
            $table->foreign('grupo_sigla')->references('sigla')->on('grupo_materias');
            $table->foreign('docente_ci')->references('ci')->on('docentes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
}
