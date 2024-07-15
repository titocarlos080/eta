<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleMenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role_id' => Role::factory(), // Associate with a random Role
            'menu_id' => Menu::factory(), // Associate with a random Menu
        ];
    }
}
