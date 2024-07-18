<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoMateria extends Model
{
    use HasFactory; 

    protected $primaryKey = 'sigla';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'sigla', 'descripcion', 'materia_sigla', 'carrera_sigla', 'docente_ci'
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_sigla', 'sigla');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_sigla', 'sigla');
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_ci', 'ci');
    }
    public function estudiantes()
    {
        return $this->hasMany(MateriaEstudiante::class, 'grupos_materias_sigla', 'sigla');
    }
    public function grupoMateriaHorarios()
    {
        return $this->hasMany(GrupoMateriaHorario::class, 'grupo_sigla', 'sigla');
    }

}
