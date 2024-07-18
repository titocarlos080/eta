<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoMateriaHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_materia_horarios', function (Blueprint $table) {
            $table->id();
            $table->string('grupo_sigla', 10);
            $table->unsignedBigInteger('horario_id');
            $table->unsignedBigInteger('dia_id');
            $table->foreign('grupo_sigla')->references('sigla')->on('grupo_materias')->onDelete('cascade');
            $table->foreign('horario_id')->references('id')->on('horarios')->onDelete('cascade');
            $table->foreign('dia_id')->references('id')->on('dias')->onDelete('cascade');
           
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
        Schema::dropIfExists('grupo_materia_horarios');
    }
}
