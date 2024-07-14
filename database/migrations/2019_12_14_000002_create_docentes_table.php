<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->string('ci')->primary(); // CI as primary key
            $table->string('nombre');
            $table->string('apellido_pat');
            $table->string('apellido_mat');
            $table->string('email')->unique();
            $table->string('kardex')->nullable(); // Allow null values if not always required
            $table->string('curriculum')->nullable();
            $table->unsignedBigInteger('usuario_id');

            $table->timestamps();

            // Foreign key constraint for usuario_id
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('docentes');
    }
}
