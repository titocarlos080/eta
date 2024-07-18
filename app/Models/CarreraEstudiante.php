<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarreraEstudiante extends Model
{
    use HasFactory;
    protected $table = 'carrera_estudiantes';

    protected $fillable = [
        'fecha_inscripcion',
        'estudiante_ci',
        'carrera_sigla',
    ];

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_ci', 'ci');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_sigla', 'sigla');
    }
 public function pagos()
    {
        return $this->hasMany(PagoCarrera::class, 'carrera_estudiante_id', 'id');
    }


}
