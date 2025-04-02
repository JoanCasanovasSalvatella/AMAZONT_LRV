<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class opinionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('opiniones')->insert([
            // Opiniones para productos de Electrónica
            ['prod_id' => 1, 'user_id' => 2, 'comentario' => 'Gran smartphone, muy rápido y con buena cámara.'],
            ['prod_id' => 1, 'user_id' => 3, 'comentario' => 'Me encanta la pantalla y la duración de la batería.'],
            ['prod_id' => 1, 'user_id' => 4, 'comentario' => 'Buen equipo, aunque esperaba un mejor rendimiento.'],

            // Opiniones para productos de Hogar
            ['prod_id' => 3, 'user_id' => 2, 'comentario' => 'Aspiradora eficiente y ligera.'],
            ['prod_id' => 3, 'user_id' => 3, 'comentario' => 'Cumple su función, aunque es algo ruidosa.'],
            ['prod_id' => 3, 'user_id' => 4, 'comentario' => 'Muy buena compra, la recomiendo.'],

            // Opiniones para productos de Ropa
            ['prod_id' => 5, 'user_id' => 2, 'comentario' => 'Chaqueta muy elegante y de buena calidad.'],
            ['prod_id' => 5, 'user_id' => 3, 'comentario' => 'El diseño es genial, pero la talla es algo justa.'],
            ['prod_id' => 5, 'user_id' => 4, 'comentario' => 'Perfecta para el invierno.'],

            // Opiniones para productos de Deportes
            ['prod_id' => 7, 'user_id' => 2, 'comentario' => 'Bicicleta resistente y fácil de manejar.'],
            ['prod_id' => 7, 'user_id' => 3, 'comentario' => 'El material es bueno, pero el sillín no es muy cómodo.'],
            ['prod_id' => 7, 'user_id' => 4, 'comentario' => 'Buena relación calidad-precio.'],

            // Opiniones para productos de Juguetes
            ['prod_id' => 9, 'user_id' => 2, 'comentario' => 'A mi hijo le encanta, muy entretenido.'],
            ['prod_id' => 9, 'user_id' => 3, 'comentario' => 'Buena calidad, pero algunas piezas son pequeñas.'],
            ['prod_id' => 9, 'user_id' => 4, 'comentario' => 'Ideal para el desarrollo de los niños.'],
        ]);
    }
}
