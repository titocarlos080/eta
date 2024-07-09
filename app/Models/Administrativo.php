<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    use HasFactory;
     // Define la clave primaria
     protected $primaryKey = 'ci';
     public $incrementing = false;
     protected $keyType = 'string';
 
     // Campos que son asignables en masa
     protected $fillable = [
         'ci', 'nombre', 'apellido_pat', 'apellido_mat', 'telefono', 'email', 'sexo', 'fecha_nacimiento', 'usuario_id'
     ];
 
     // Relación con el modelo User
     public function usuario()
     {
         return $this->belongsTo(User::class, 'usuario_id');
     }
}
