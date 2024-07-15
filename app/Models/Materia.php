<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materias';
    protected $primaryKey = 'sigla';
    protected $keyType = 'string'; 
    protected $fillable = ['sigla', 'descripcion', 'observacion', 'creditos' ,'estado' ]; 
 
// In your Materia model
protected $casts = [
    // Remove 'sigla' => 'integer' if it exists
];
}

/*CREATE TABLE materias (
    sigla VARCHAR(255) PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    observacion VARCHAR(255) NOT NULL,
    creditos INT NOT NULL,
    estado 

);*/