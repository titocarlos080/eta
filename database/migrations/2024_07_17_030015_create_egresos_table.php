<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresos', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto', 10, 2); // Crea un campo monto de tipo DECIMAL(10,2)
            $table->dateTime('fecha'); // Crea un campo fecha de tipo DATE
            $table->string('concepto', 255); // Crea un campo concepto de tipo VARCHAR(255)
            $table->integer('gestion_codigo');
            $table->boolean('anulado')->default(false); //estado
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
        Schema::dropIfExists('egresos');
    }
}
