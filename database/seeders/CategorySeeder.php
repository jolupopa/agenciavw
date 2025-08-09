<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          Category::create([
            'name' =>  $name = 'Venta',
            'slug' => 'venta'
        ]);

        Category::create([
            'name' =>  $name = 'Alquiler',
            'slug' => 'alquiler'
        ]);

        Category::create([
            'name' =>  $name = 'Proyecto',
            'slug' => 'proyecto'
        ]);
    }
}
