<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Proyect;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyect>
 */
class ProyectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [


            'code' => $this->faker->unique()->bothify('??####'),
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'address' =>  Str::limit($this->faker->address, 42),

            'longitud' => '-79.0287019135900',
            'latitud' => '-8.111851918254834',
            'is_land_proyect' => false,


            'visibilidad' => $this->faker->randomElement($array = array ('regular','destacada', 'superdestacada')),
            'estado' => 'publicada',
            'active' => true ,

            'zona_id' => null,
            'departamento_id'=> 1,
            'provincia_id' => 1,
            'distrito_id' => rand(1, 2),



            'category_id' => rand(1, 2),
            'user_id' => 1, //rand(1,10),

            'typeproperty_id' => rand(1, 6),

            'published_at' => $this->faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now', $timezone = null),
            'published_end' => $this->faker->dateTimeBetween($startDate = '-5 days', $endDate = '30 days', $timezone = null),

        ];
    }
}
