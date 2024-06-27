<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiantes extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'apellidos',
        'carnet',
        'carrera_nivel'
        
        
    ];
   
    public function carreras()
    {
        return $this->belongsToMany(Carreras::class, 'carrera_estudiantes', 'estudiante_id', 'carrera_id')
            ->join('carrera_niveles', 'carreras.id', '=', 'carrera_niveles.carrera_id')
            ->join('niveles', 'carrera_niveles.nivel_id', '=', 'niveles.id')
            ->select('carreras.nombre as carrera_nombre', 'niveles.nombre as nivel_nombre')
            ->withTimestamps();
    }

    public function pagos(){
        return $this->hasMany(Pagos::class, 'id');

    }


   
}
