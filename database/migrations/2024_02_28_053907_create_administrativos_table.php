
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativosTable  extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrativos', function (Blueprint $table) {
            $table->string('ci')->primary(); // Clave primaria
            $table->string('nombre');
            $table->string('apellido_pat');
            $table->string('apellido_mat');
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable(); // Relación con User
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('set null');
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
        Schema::dropIfExists('administrativos');
    }
}
