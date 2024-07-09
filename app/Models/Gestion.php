<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'gestiones';

    protected $primaryKey = 'codigo';

    protected $fillable = [
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function carreras()
    {
        return $this->hasMany(Carrera::class, 'gestion_codigo', 'codigo');
    }
}
