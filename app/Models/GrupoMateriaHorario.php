<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoMateriaHorario extends Model
{
    use HasFactory;
    
    protected $table = 'grupo_materia_horarios';
    
    protected $fillable = [
        'grupo_sigla',
        'horario_id',
        'dia_id'
    ];

    public function grupoMateria()
    {
        return $this->belongsTo(GrupoMateria::class, 'grupo_sigla', 'sigla');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_id', 'id');
    }

    public function dia()
    {
        return $this->belongsTo(Dia::class, 'dia_id', 'id');
    }
}
