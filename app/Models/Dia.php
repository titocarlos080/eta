<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    use HasFactory;
    
     // Campos que son asignables en masa
     protected $timetamps =false;
     protected $fillable = ['nombre'];
     public function grupoMateriaHorarios()
     {
         return $this->hasMany(GrupoMateriaHorario::class, 'dia_id', 'id');
     }
}
