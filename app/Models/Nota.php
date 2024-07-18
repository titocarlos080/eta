<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    
    protected $table = 'notas';
    public $timestamps = false;
    protected $fillable = ['nota_final', 'estudiante_materia_id']; 
    
    public function materia_estudiante()
    {
        return $this->belongsTo(MateriaEstudiante::class, 'estudiante_materia_id', 'id');
    }


}

/*
CREATE TABLE notas (
    id SERIAL PRIMARY KEY,
    nota_final NUMERIC(5, 2) NOT NULL CHECK (nota_final >= 1 AND nota_final <= 100),
    estudiante_materia_id INT NOT NULL, 
     FOREIGN KEY(estudiante_materia_id) REFERENCES estudiante_materia(id)
 );
*/