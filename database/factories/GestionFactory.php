<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GestionFactory  extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fechaInicio = $this->faker->dateTimeBetween('-2 years', 'now'); // Start date up to 2 years ago
        $fechaFin = Carbon::instance($fechaInicio)->addYear(); // End date is one year after start date

        return [
            'codigo' => $this->faker->unique()->numerify('####'), // Unique 4-digit code
            'descripcion' => $this->faker->sentence(),
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
        ];
    }
}
