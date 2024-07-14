<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{use HasFactory;

    // Table name (optional, Laravel will infer 'role_menus' by default)
    protected $table = 'role_menus';

    // Fillable fields
    protected $fillable = ['role_id', 'menu_id'];

    // Disable timestamps if you don't need them
    public $timestamps = true;

    // Relationship with the Role model
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relationship with the Menu model
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

}
