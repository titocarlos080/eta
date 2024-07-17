<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory; 
    protected $table = 'horarios';

    protected $fillable = [
        'hora_inicio',
        'hora_fin',
    ];
    public function grupoMateriaHorarios()
    {
        return $this->hasMany(GrupoMateriaHorario::class, 'horario_id', 'id');
    }
    
}
// CREATE TABLE horarios (
//     id SERIAL PRIMARY KEY,
//     hora_inicio TIME NOT NULL,
//     hora_fin TIME NOT NULL
// );