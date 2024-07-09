<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $primaryKey = 'ci';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ci', 'nombre', 'apellido_pat', 'apellido_mat', 'email', 'telefono', 'sexo', 'fecha_nacimiento', 'usuario_id'
    ];

    // Define la relación con el modelo User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
