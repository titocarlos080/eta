<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_materias', function (Blueprint $table) {
            $table->string('sigla')->primary(); // Sigla as primary key (string type)
            $table->string('descripcion');
            $table->string('materia_sigla'); // Foreign key to materias table
            $table->string('carrera_sigla');  // Foreign key to carreras table
            $table->string('docente_ci')->nullable(); // Foreign key to docentes table, allow null
            $table->timestamps(); // Add created_at and updated_at columns
            // Foreign Key Constraints
            $table->foreign('materia_sigla')->references('sigla')->on('materias');
            $table->foreign('carrera_sigla')->references('sigla')->on('carreras');
            $table->foreign('docente_ci')->references('ci')->on('docentes');
     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_materias');
    }
}
