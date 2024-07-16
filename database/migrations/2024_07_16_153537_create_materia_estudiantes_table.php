<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_estudiante', function (Blueprint $table) {
            $table->id(); // Agrega una columna 'id' con auto-incremento
            $table->date('fecha'); // Columna para la fecha
            $table->string('grupos_materias_sigla', 10); // Columna para la sigla de grupos de materias
            $table->string('estudiante_ci', 20); // Columna para el CI del estudiante

            // Definición de claves foráneas
            $table->foreign('grupos_materias_sigla')
                ->references('sigla')
                ->on('grupo_materias')
                ->onDelete('cascade'); // Eliminar en cascada si se elimina el grupo de materias

            $table->foreign('estudiante_ci')
                ->references('ci')
                ->on('estudiantes')
                ->onDelete('cascade'); // Eliminar en cascada si se elimina el estudiante

            $table->timestamps(); // Agrega las columnas de timestamps

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materia_estudiante');
    }
}
