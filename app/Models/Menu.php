<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    // Nombre de la tabla en la base de datos
    protected $table = 'menus';

    // Campos que son asignables en masa
    protected $fillable = ['nombre', 'ruta'];

    // Si el nombre de la clave primaria no es 'id', defínelo aquí
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
}
