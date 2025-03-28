<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            'nombre' => Str::random(10),
            'oferta' => (bool)rand(0, 1), // Genera true (1) o false (0)
            'imagen' => Str::random(10),
            'descripcion' => Str::random(20),
            'precio' => rand(10, 100) . '.99',
            'precioAnterior' => rand(10, 100) . '.99',
            'cat_id' => rand(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'nombre' => Str::random(10),
            'oferta' => (bool)rand(0, 1), // Genera true (1) o false (0)
            'imagen' => Str::random(10),
            'descripcion' => Str::random(20),
            'precio' => rand(10, 100) . '.99',
            'precioAnterior' => rand(10, 100) . '.99',
            'cat_id' => rand(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'nombre' => Str::random(10),
            'oferta' => (bool)rand(0, 1), // Genera true (1) o false (0)
            'imagen' => Str::random(10),
            'descripcion' => Str::random(20),
            'precio' => rand(10, 100) . '.99',
            'precioAnterior' => rand(10, 100) . '.99',
            'cat_id' => rand(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
