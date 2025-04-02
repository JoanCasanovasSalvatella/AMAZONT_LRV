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
            // Electrónica (en oferta)
            [
                'id' => 1,
                'nombre' => 'Smartphone X',
                'oferta' => true,
                'imagen' => 'smartphone_x.jpg',
                'descripcion' => 'Un smartphone de última generación con cámara de alta resolución.',
                'precio' => 799.99,
                'precioAnterior' => 999.99,
                'cantidad' => 50,
                'cat_id' => 1,
                'user_id' => 4,
            ],
            [
                'id' => 2,
                'nombre' => 'Laptop Pro',
                'oferta' => true,
                'imagen' => 'laptop_pro.jpg',
                'descripcion' => 'Una laptop potente para trabajo y gaming.',
                'precio' => 1299.99,
                'precioAnterior' => 1499.99,
                'cantidad' => 30,
                'cat_id' => 1,
                'user_id' => 4,
            ],

            // Hogar (sin oferta)
            [
                'id' => 3,
                'nombre' => 'Aspiradora 3000',
                'oferta' => false,
                'imagen' => 'aspiradora_3000.jpg',
                'descripcion' => 'Aspiradora inalámbrica con gran poder de succión.',
                'precio' => 199.99,
                'precioAnterior' => null,
                'cantidad' => 40,
                'cat_id' => 2,
                'user_id' => 1,
            ],
            [
                'id' => 4,
                'nombre' => 'Cafetera Express',
                'oferta' => false,
                'imagen' => 'cafetera_express.jpg',
                'descripcion' => 'Cafetera automática para preparar el mejor café.',
                'precio' => 89.99,
                'precioAnterior' => null,
                'cantidad' => 35,
                'cat_id' => 2,
                'user_id' => 1,
            ],

            // Ropa (en oferta)
            [
                'id' => 5,
                'nombre' => 'Chaqueta de cuero',
                'oferta' => true,
                'imagen' => 'chaqueta_cuero.jpg',
                'descripcion' => 'Chaqueta de cuero genuino con diseño moderno.',
                'precio' => 149.99,
                'precioAnterior' => 199.99,
                'cantidad' => 20,
                'cat_id' => 3,
                'user_id' => 1,
            ],
            [
                'id' => 6,
                'nombre' => 'Zapatillas deportivas',
                'oferta' => true,
                'imagen' => 'zapatillas_deportivas.jpg',
                'descripcion' => 'Zapatillas cómodas y ligeras para correr.',
                'precio' => 79.99,
                'precioAnterior' => 99.99,
                'cantidad' => 50,
                'cat_id' => 3,
                'user_id' => 1,
            ],

            // Deportes (sin oferta)
            [
                'id' => 7,
                'nombre' => 'Bicicleta de montaña',
                'oferta' => false,
                'imagen' => 'bicicleta_montana.jpg',
                'descripcion' => 'Bicicleta resistente para terrenos difíciles.',
                'precio' => 499.99,
                'precioAnterior' => null,
                'cantidad' => 15,
                'cat_id' => 4,
                'user_id' => 1,
            ],
            [
                'id' => 8,
                'nombre' => 'Pesas ajustables',
                'oferta' => false,
                'imagen' => 'pesas_ajustables.jpg',
                'descripcion' => 'Pesas ajustables para entrenamientos personalizados.',
                'precio' => 129.99,
                'precioAnterior' => null,
                'cantidad' => 25,
                'cat_id' => 4,
                'user_id' => 1,
            ],

            // Juguetes (en oferta)
            [
                'id' => 9,
                'nombre' => 'Set de construcción',
                'oferta' => true,
                'imagen' => 'set_construccion.jpg',
                'descripcion' => 'Juguete educativo para desarrollar la creatividad.',
                'precio' => 49.99,
                'precioAnterior' => 69.99,
                'cantidad' => 60,
                'cat_id' => 5,
                'user_id' => 1,
            ],
            [
                'id' => 10,
                'nombre' => 'Muñeca interactiva',
                'oferta' => true,
                'imagen' => 'muneca_interactiva.jpg',
                'descripcion' => 'Muñeca que habla y canta canciones.',
                'precio' => 39.99,
                'precioAnterior' => 59.99,
                'cantidad' => 70,
                'cat_id' => 5,
                'user_id' => 1,
            ],
        ]);
    }
}
