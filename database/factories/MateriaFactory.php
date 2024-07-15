<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MateriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {return [
        'sigla' => $this->faker->unique()->lexify('???'), 
        'descripcion' => $this->faker->sentence(),
        'observacion' => $this->faker->paragraph(),
        'creditos' => $this->faker->numberBetween(1, 6), 
        'estado' => $this->faker->boolean(), 
    ];
    }
}
