<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    use HasFactory;
    protected $fillable = [
       'concepto',
       'fecha',
       'monto',
       'mes_pago',
       'estudiante_ci'
    ];
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_ci');
    }
      public function carrera()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_ci');
    }

    
}
