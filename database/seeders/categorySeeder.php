<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            'nombre' => Str::random(10),
            'imagen' => rand(1, 10), // Puede ser un ID o una referencia de imagen
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => Str::random(10),
            'imagen' => rand(1, 10), // Puede ser un ID o una referencia de imagen
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categorias')->insert([
            'nombre' => Str::random(10),
            'imagen' => rand(1, 10), // Puede ser un ID o una referencia de imagen
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
