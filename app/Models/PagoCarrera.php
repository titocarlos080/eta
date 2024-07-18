<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoCarrera extends Model
{
    use HasFactory;
    protected $table = 'pago_carreras';
    public $timestamps = false;

    protected $fillable = ['monto', 'fecha','concepto','estado','carrera_estudiante_id'];

    public function carrera_estudiante()
    {
        return $this->belongsTo(CarreraEstudiante::class, 'carrera_estudiante_id', 'id');
    }

}


/*
CREATE TABLE pago_carreras (
    id SERIAL PRIMARY KEY,
    monto DECIMAL(10,2) NOT NULL,
    fecha DATE NOT NULL,
    concepto VARCHAR(255) NOT NULL,
    estado VARCHAR(50),
    carrera_estudiante_id INT NOT NULL, 
    FOREIGN KEY(carrera_estudiante_id) REFERENCES carrera_estudiantes(id)
 
);
 */