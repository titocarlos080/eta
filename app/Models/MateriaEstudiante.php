<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaEstudiante extends Model
{
    use HasFactory;

    // Especifica la tabla si el nombre no sigue la convención plural
    protected $table = 'materia_estudiante';
    protected $fillable = [
        'fecha',
        'grupos_materias_sigla',
        'estudiante_ci',
    ];
    // Define las relaciones
    public function grupoMateria()
    {
        return $this->belongsTo(GrupoMateria::class, 'grupos_materias_sigla', 'sigla');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_ci', 'ci');
    }
}
