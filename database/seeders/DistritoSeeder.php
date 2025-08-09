<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Distrito;
use Illuminate\Support\Str;

class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Distrito::create([ // row 1
               'name' =>   $name = 'TRUJILLO',
                'slug'=> Str::slug($name, '_'),
               'provincia_id' => 1,
               'departamento_id' => 1,
        ]);
        Distrito::create([ // row 2
               'name' =>   $name = 'VICTOR LARCO HERRERA',
                'slug'=> Str::slug($name, '_'),
               'provincia_id' => 1,
               'departamento_id' => 1,
        ]);
    }
}
