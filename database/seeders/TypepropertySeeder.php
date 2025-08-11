<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Typeproperty;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypepropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // 1
         Typeproperty::create([
            'name' =>  $name = 'Casa',
            'slug'=> Str::slug($name, '_'),
            'type' => 'habitat',
        ]);

        // 2
          Typeproperty::create([
            'name' =>  $name = 'Departamento',
            'slug'=> Str::slug($name, '_'),
            'type' => 'habitat',
        ]);


        // 3
        Typeproperty::create([
            'name' =>  $name = 'Tienda comercial',
            'slug'=> Str::slug($name, '_'),
            'type' => 'habitat',

        ]);

          // 4
        Typeproperty::create([
            'name' =>  $name = 'Oficina',
            'slug'=> Str::slug($name, '_'),
            'type' => 'habitat',

        ]);

        // 5
        Typeproperty::create([
            'name' =>  $name = 'Terreno urbano',
            'slug'=> Str::slug($name, '_'),
            'type' => 'terreno',
        ]);

        // 6
        Typeproperty::create([
            'name' =>  $name = 'Terreno agricola',
            'slug'=> Str::slug($name, '_'),
            'type' => 'terreno',
        ]);

        // 7
        Typeproperty::create([
            'name' =>  $name = 'Terreno industrial',
            'slug'=> Str::slug($name, '_'),
            'type' => 'terreno',
        ]);

        // 8
        Typeproperty::create([
            'name' =>  $name = 'Proyecto industrial',
            'slug'=> Str::slug($name, '_'),
            'type' => 'proyecto',
        ]);

        // 9
        Typeproperty::create([
            'name' =>  $name = 'Proyecto urbano',
            'slug'=> Str::slug($name, '_'),
            'type' => 'proyecto',
        ]);

    }
}
