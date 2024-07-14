<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     // Define la clave primaria
     protected $primaryKey = 'id';
     public $incrementing = true;
     protected $keyType = 'int';
 
     // Campos que son asignables en masa
     protected $fillable = ['nombre'];
 
     // Relación con el modelo User
     public function users()
     {
         return $this->hasMany(User::class, 'rol_id');
     }

     
    public function menus()
    {
        return $this->hasMany(RoleMenu::class, 'rol_id');
    }
}
