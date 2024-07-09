<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    // Define la clave primaria
    protected $primaryKey = 'ci';
    public $incrementing = false;
    protected $keyType = 'string';

    // Campos que son asignables en masa
    protected $fillable = [
        'ci', 'nombre', 'apellido_pat', 'apellido_mat', 'email', 'kardex', 'curriculum', 'usuario_id'
    ];

    // Relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
