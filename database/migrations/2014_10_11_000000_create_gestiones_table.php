<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGestionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//  protected $fillable = [
//         'descripcion',
//         'fecha_inicio',
//         'fecha_fin',
//     ];
        Schema::create('gestiones', function (Blueprint $table) {
            $table->id('codigo');  // Assuming 'codigo' is a string
            $table->string('descripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->timestamps(); // Add created_at and updated_at columns
   
            // Optional: Foreign key constraint for parent_id
           // $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('gestiones');
    }
}
