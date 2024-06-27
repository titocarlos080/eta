<?php

namespace App\Models;
use App\Models\Niveles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carreras extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'duracion'
        
        
    ];

    public function niveles()
    {
        return $this->belongsToMany(Niveles::class, 'carrera_niveles', 'carrera_id', 'nivel_id');
    }
    
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiantes::class, 'carrera_estudiantes', 'carrera_id', 'estudiante_id')
            ->withTimestamps();
    }
}
