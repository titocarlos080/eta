<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TematicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
         
        return [
            'nombre' => $this->faker->unique()->word, // Generates unique thematic names
        ];
    }
}
