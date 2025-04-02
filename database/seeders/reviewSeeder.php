<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class reviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('valoraciones')->insert([
            // Valoraciones para productos de Electrónica
            ['prod_id' => 1, 'user_id' => 2, 'puntuacion' => 5],
            ['prod_id' => 1, 'user_id' => 3, 'puntuacion' => 4],
            ['prod_id' => 1, 'user_id' => 4, 'puntuacion' => 3],

            // Valoraciones para productos de Hogar
            ['prod_id' => 3, 'user_id' => 2, 'puntuacion' => 4],
            ['prod_id' => 3, 'user_id' => 3, 'puntuacion' => 3],
            ['prod_id' => 3, 'user_id' => 4, 'puntuacion' => 5],

            // Valoraciones para productos de Ropa
            ['prod_id' => 5, 'user_id' => 2, 'puntuacion' => 4],
            ['prod_id' => 5, 'user_id' => 3, 'puntuacion' => 4],
            ['prod_id' => 5, 'user_id' => 4, 'puntuacion' => 5],

            // Valoraciones para productos de Deportes
            ['prod_id' => 7, 'user_id' => 2, 'puntuacion' => 4],
            ['prod_id' => 7, 'user_id' => 3, 'puntuacion' => 3],
            ['prod_id' => 7, 'user_id' => 4, 'puntuacion' => 5],

            // Valoraciones para productos de Juguetes
            ['prod_id' => 9, 'user_id' => 2, 'puntuacion' => 5],
            ['prod_id' => 9, 'user_id' => 3, 'puntuacion' => 4],
            ['prod_id' => 9, 'user_id' => 4, 'puntuacion' => 3],
        ]);
    }
}
