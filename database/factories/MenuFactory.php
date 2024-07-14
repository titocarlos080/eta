<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'url' => $this->faker->url,
            'icon' => $this->faker->randomElement(['fas fa-home', 'fas fa-users', 'fas fa-cog', 'fas fa-chart-line']),
            'parent_id' => null, // Top-level menu item by default
            'order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
