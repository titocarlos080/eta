<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'usuarios';

    protected $fillable = [
       'name', 'email', 'password', 'password_reset', 'rol_id', 'tematica_id'
    ];



    // Define the relationships
    public function rol()
    {
        return $this->belongsTo(Role::class, 'rol_id', 'id');
    }

    public function tematica()
    {
        return $this->belongsTo(Tematica::class, 'tematica_id', 'id');
    }

    // Otros métodos y propiedades

    public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'usuario_id');
    }

    public function docentes()
    {
        return $this->hasMany(Docente::class, 'usuario_id');
    }

    public function administrativos()
    {
        return $this->hasMany(Administrativo::class, 'usuario_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
