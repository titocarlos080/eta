<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tematica extends Model
{
    use HasFactory;

     // Si el nombre de la tabla no es plural, especifícalo aquí
     protected $table = 'tematicas';

     // Especifica los campos que se pueden llenar
     protected $fillable = [
         'nombre',
     ];
}
