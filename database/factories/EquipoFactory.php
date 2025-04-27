<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipo>
 */
class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company,
            'imagen' => $this->faker->imageUrl(640, 480, 'sports', true),
            'fundacion' => $this->faker->year,
            'descripcion' => $this->faker->paragraph,
            'user_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
