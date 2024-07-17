<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;
    // Definición de la clave primaria (si no es 'id')
    protected $primaryKey = 'id';

    // Especificar que la clave primaria es un entero autoincremental
    public $incrementing = true;
    protected $fillable = [
        'monto', 'fecha', 'concepto', 'gestion_codigo','anulado'
    ];

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'gestion_codigo');
    }
}
//CREATE TABLE egresos (
  //  id SERIAL PRIMARY KEY,
   // monto DECIMAL(10,2) NOT NULL,
   // fecha DATE NOT NULL,
   // concepto VARCHAR(255) NOT NULL,
   // gestion_codigo INT NOT NULL,
   // FOREIGN KEY(gestion_codigo) REFERENCES gestiones(codigo)
 
// );