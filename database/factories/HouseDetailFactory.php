<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApartamentDetails>
 */
class HouseDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
               
            'subtitle' => $this->faker->paragraph($nbSentences = 1, $variableNbSentences = true),
		    'price' => rand(15000, 50000),
            'detalle' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'area_total' => rand(100, 500),
            'bedrooms' => $this->faker->numberBetween(1, 3),
            'bathrooms' => $this->faker->numberBetween(1, 2),
            $has_garage = 'has_garage' => $this->faker->boolean(),
            'num_pisos' => rand(1, 5),
            'num_cuartos' => rand(1, 4),
            'num_cars' =>  ($has_garage == true) ? rand(1, 2) : 0,
             'url_video' => $this->faker->url,
            'url_plano' => $this->faker->url,
            'url_plano2' => $this->faker->url,

        ];
    }
}
