<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LibroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'autor' => $this->faker->name,
            'titulo' => $this->faker->name,
            'edicion' => $this->faker->numberBetween(1,999),
            'datosPublicacion' => $this->faker->paragraph(),
            'tipoContenido' => $this->faker->name,
            'restricciones' => $this->faker->name,
            'materia' => $this->faker->name,
            'proveedor' => $this->faker->name
        ];
    }
}
