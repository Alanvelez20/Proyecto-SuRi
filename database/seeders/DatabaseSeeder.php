<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->create([
                'name' => 'Admin',
                'email' => 'surimx2024@gmail.com',
                'password' => Hash::make('Masterpw123'),
                'rol' => 'admin',
            ]);
            
        User::factory()
            ->create([
                'name' => 'Test',
                'email' => 'alanvelez20@gmail.com',
                'password' => Hash::make('Alanvelez20'),
                'rol' => 'usuario',
            ]);
    }
}
