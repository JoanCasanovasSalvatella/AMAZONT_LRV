<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            userSeeder::class,
            categorySeeder::class,
            productSeeder::class,
            opinionSeeder::class,
            reviewSeeder::class,
            cartSeeder::class,
            shopSeeder::class
        ]);
    }
}
