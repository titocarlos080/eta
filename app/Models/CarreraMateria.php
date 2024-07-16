<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarreraMateria extends Model
{
    use HasFactory;

    protected $table = 'carrera_materias';
    public $timestamps = true; // No auto-incrementing ID

    protected $fillable = ['nivel_id', 'materia_sigla', 'carrera_sigla'];

    // Relationships (optional, if you need them)
    public function nivel()
    {
        return $this->belongsTo(niveles::class, 'nivel_id', 'id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_sigla', 'sigla');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_sigla', 'sigla');
    }
}
