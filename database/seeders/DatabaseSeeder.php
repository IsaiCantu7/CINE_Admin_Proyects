<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un usuario admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // Asegúrate de cambiar 'password' por una contraseña segura
            'rol' => 'admin',
        ]);

        User::create([
            'name' => 'seller',
            'email' => 'seller@gmail.com',
            'password' => Hash::make('password'), // Asegúrate de cambiar 'password' por una contraseña segura
            'rol' => 'seller',
        ]);


        User::create([
            'name' => 'client',
            'email' => 'client@gmail.com',
            'password' => Hash::make('password'), // Asegúrate de cambiar 'password' por una contraseña segura
            'rol' => 'client',
        ]);
    }
}
