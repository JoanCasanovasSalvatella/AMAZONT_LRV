<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class shopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('compras')->insert([
            // Carrito del cliente (usuario con ID 3)
            ['user_id' => 2, 'prod_id' => 1, 'cantidad' => 2, 'precio_producto' => 199.99, 'total' => 399.98],
            ['user_id' => 2, 'prod_id' => 2, 'cantidad' => 1, 'precio_producto' => 49.99, 'total' => 49.99],
            ['user_id' => 2, 'prod_id' => 5, 'cantidad' => 1, 'precio_producto' => 79.99, 'total' => 79.99],
        ]);
    }
}
