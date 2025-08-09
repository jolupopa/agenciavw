<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LandDetails>
 */
class LandDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area_sq_meters' => $this->faker->numberBetween(100, 10000),
            'soil_type' => $this->faker->randomElement(['agricola', 'industrial', 'urbano']),
            'price' => $this->faker->numberBetween(100000, 1000000),
             
        ];
    }
}
