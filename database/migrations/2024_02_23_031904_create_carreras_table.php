<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->string('sigla')->primary();
            // Otras columnas
            $table->string('descripcion');
            $table->integer('gestion_codigo');
            // Columnas de timestamps para created_at y updated_at
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('gestion_codigo')->references('codigo')->on('gestiones')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carreras');
    }
}
