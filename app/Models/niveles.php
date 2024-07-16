<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class niveles extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nombre',
    ];
    public function niveles()
    {
        return $this->hasMany(Niveles::class);
    } 
    public function carrera_materias()
    {
        return $this->hasMany(CarreraMateria::class,'nivel_id','id');
    }



}
