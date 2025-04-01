<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'AMAZONT',
            'email' => 'amazont@amazont.com',
            'password' => Hash::make('admiin'),
            'rol' => 'Administrador'
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'adress' => Str::random(10),
            'password' => Hash::make('password'),
            'rol' => 'Vendedor'
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'adress' => Str::random(10),
            'password' => Hash::make('password'),
            'rol' => 'Cliente'
        ]);
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@example.com',
            'adress' => Str::random(10),
            'password' => Hash::make('password'),
            'rol' => 'Cliente'
        ]);
    }
}
