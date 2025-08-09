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
         Typeproperty::create([
            'name' =>  $name = 'Casa',
            'slug'=> Str::slug($name, '_'),
        ]);

          Typeproperty::create([
            'name' =>  $name = 'Departamento',
            'slug'=> Str::slug($name, '_'),
        ]);

        Typeproperty::create([
            'name' =>  $name = 'Tienda comercial',
            'slug'=> Str::slug($name, '_'),

        ]);

        Typeproperty::create([
            'name' =>  $name = 'Terreno urbano',
            'slug'=> Str::slug($name, '_'),
        ]);

        Typeproperty::create([
            'name' =>  $name = 'Oficina',
            'slug'=> Str::slug($name, '_'),

        ]);

        Typeproperty::create([
            'name' =>  $name = 'Terreno agricola',
            'slug'=> Str::slug($name, '_'),
        ]);

        Typeproperty::create([
            'name' =>  $name = 'Terreno industrial',
            'slug'=> Str::slug($name, '_'),
        ]);

    }
}
