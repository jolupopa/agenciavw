<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provincia;
use Illuminate\Support\Str;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Provincia::create([  'name' => $name = 'Trujillo',
            'slug' => Str::slug($name, '_'),
            'departamento_id' => 1 ,

        ]);
    }
}
