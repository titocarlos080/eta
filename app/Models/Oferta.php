<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;
    protected $fillable = [
        'gestion_codigo',
        'carrera_sigla',
        'materia_sigla',
        'grupo_sigla',
        'docente_ci',
    ];
    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'gestion_codigo', 'codigo');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_sigla', 'sigla');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_sigla', 'sigla');
    }

    public function grupo()
    {
        return $this->belongsTo(GrupoMateria::class, 'grupo_sigla', 'sigla');
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_ci', 'ci');
    }
}
