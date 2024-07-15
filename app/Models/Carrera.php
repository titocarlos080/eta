<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = 'carreras';

    protected $primaryKey = 'sigla';
    protected $keyType = 'string'; 

    public $incrementing = false; // La clave primaria no es autoincremental

    protected $fillable = [
        'sigla',
        'descripcion',
        'gestion_codigo',
    ];

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'gestion_codigo', 'codigo');
    }
}
