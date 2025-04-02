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
            [
                'id' => 1,
                'nombre' => 'Electrónica',
                'imagen' => 'electronica.jpg',
            ],
            [
                'id' => 2,
                'nombre' => 'Hogar',
                'imagen' => 'hogar.jpg',
            ],
            [
                'id' => 3,
                'nombre' => 'Ropa',
                'imagen' => 'ropa.jpg',
            ],
            [
                'id' => 4,
                'nombre' => 'Deportes',
                'imagen' => 'deportes.jpg',
            ],
            [
                'id' => 5,
                'nombre' => 'Juguetes',
                'imagen' => 'juguetes.jpg',
            ],
        ]);
    }
}
