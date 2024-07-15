<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = ['name', 'url', 'icon', 'parent_id', 'order']; 


    // Relationship for sub-menus
    public function submenus()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order'); 
    }

    // Optional: Relationship for parent menu (if needed)
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
    public function roles()
    {
        return $this->hasMany(RoleMenu::class, 'menu_id');
    }

}
