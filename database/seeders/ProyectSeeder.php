<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HabitatProyect;
use App\Models\LandProyect;
use App\Models\Proyect;
use App\Models\Category;
use App\Models\Typeproperty;
use Faker\Generator as Faker;


class ProyectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        $visibilidad = 'regular';
        $estado = 'publicada';

        $habitatIds = [1, 2, 3, 4, ]; // IDs para tipos de casa (ej. Casa, Departamento, etc.)
        $terrenoIds = [5, 6, 7]; // 4 = Urbano, 6 = Agrícola, 7 = Industrial
        $proyectoIds = [8, 9]; // IDs para tipos de casa (ej. Casa, Departamento, etc.)

        $categoryIds = [1, 2, 3]; // 1 = Venta, 2 = Alquiler,

        // 1. Crear 10 propiedades de tipo 'terreno' con Land
        $proyect= Proyect::factory(10)->create([

            'typeproperty_id' => rand(5, 7),

            'category_id' => rand(1, 2),
            'is_land_proyect' => true,
        ])->each(function($proyect) {
                    $num_anuncios = rand(1, 3);
                LandProyect::factory($num_anuncios)->create(
                    [
                        'proyect_id' => $proyect->id,

                    ]
                );

        });

        // 2. Crear 10 propiedades de tipo 'habitat' con Habitat
        $proyect= Proyect::factory(10)->create([

            'typeproperty_id' => rand(1, 4),
            'category_id' => rand(1, 2),
             'is_land_proyect' => false,
        ])->each(function($proyect) {
                        $num_anuncios = rand(1, 3);
                HabitatProyect::factory($num_anuncios)->create(
                    [
                        'proyect_id' => $proyect->id,


                    ]
                );

        });

    }
}
