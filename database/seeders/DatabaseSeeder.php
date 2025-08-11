<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Typeproperty;
use App\Models\Category;
use App\Models\Property;


use Database\Seeders\TypepropertySeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(1)->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
         ]);

        $this->call(DepartamentoSeeder::class);

        $this->call(ProvinciaSeeder::class);

        $this->call(DistritoSeeder::class);


        $this->call(TypepropertySeeder::class);

        $this->call(CategorySeeder::class);

        $this->call(PropertySeeder::class);

        $this->call(ProyectSeeder::class);
    }
}
