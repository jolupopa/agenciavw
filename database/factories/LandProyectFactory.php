<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LandProyect>
 */
class LandProyectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'proyect_id' => $this->faker->unique(),
            'area' => $this->faker->numberBetween(100, 10000),
            'price' => $this->faker->numberBetween(100000, 1000000),
        ];
    }
}
