<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoMateria extends Model
{
    use HasFactory;
    protected $table = 'pago_carreras';
    public $timestamps = false;
    protected $fillable = ['monto', 'fecha','concepto','estado','estudiante_materia_id'];

    public function estudiante_materia()
    {
        return $this->belongsTo(CarreraEstudiante::class, 'estudiante_materia_id', 'id');
    }

}
/*

CREATE TABLE pago_materias (
    id SERIAL PRIMARY KEY,
    monto DECIMAL(10,2) NOT NULL,
    fecha DATE NOT NULL,
    concepto VARCHAR(255) NOT NULL,
    estado VARCHAR(50),
    estudiante_materia_id INT NOT NULL, 
    FOREIGN KEY(estudiante_materia_id) REFERENCES estudiante_materia(id)
 
);*/