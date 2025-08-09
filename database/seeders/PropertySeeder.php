<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\HouseDetail;
use App\Models\LandDetail;
use App\Models\Category;
use App\Models\Typeproperty;
use Faker\Generator as Faker;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
          // Define los IDs para los diferentes tipos de propiedad
        $terrenoTypeIds = [4, 6, 7]; // 4 = Urbano, 6 = Agrícola, 7 = Industrial
        $houseTypeIds = [1, 2, 3, 5]; // IDs para tipos de casa (ej. Casa, Departamento, etc.)
        $categoryIds = [1, 2]; // 1 = Venta, 2 = Alquiler

        // 1. Crear 10 propiedades de tipo 'terreno' con LandDetail
        // Estas son propiedades principales, por lo tanto parent_id es null.
        for ($i = 0; $i < 10; $i++) {
            $landDetail = LandDetail::factory()->create();
            Property::factory()->create([
                'parent_id' => null,
                'property_type' => LandDetail::class,
                'property_id' => $landDetail->id,
                'typeproperty_id' => $faker->randomElement($terrenoTypeIds),
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }

        // 2. Crear 5 propiedades "padre" de tipo 'casa' y sus detalles.
        // Ahora se crea el HouseDetail para cada una de las 5 propiedades principales.
        $houseParentProperties = collect(); // Usamos una colección para guardar las propiedades padre
        for ($i = 0; $i < 5; $i++) {
            $houseDetail = HouseDetail::factory()->create();
            $parentProperty = Property::factory()->create([
                'parent_id' => null,
                'property_type' => HouseDetail::class,
                'property_id' => $houseDetail->id,
                'typeproperty_id' => $faker->randomElement($houseTypeIds),
                'category_id' => $faker->randomElement($categoryIds),
            ]);
            $houseParentProperties->push($parentProperty);
        }

        // 3. Para cada propiedad "padre" de casa, crear entre 1 y 3 propiedades "hijas".
        foreach ($houseParentProperties as $parent) {
            $numberOfChildren = $faker->numberBetween(1, 3);
            for ($i = 0; $i < $numberOfChildren; $i++) {
                 $houseDetail = HouseDetail::factory()->create();
                // Las propiedades "hijas" apuntan a su propiedad padre.
                Property::factory()->create([
                    'parent_id' => $parent->id,
                    'property_type' => HouseDetail::class,
                    'property_id' => $houseDetail->id,
                    'typeproperty_id' => $faker->randomElement($houseTypeIds),
                    'category_id' => $faker->randomElement($categoryIds),
                ]);
            }
        }
    }
}
