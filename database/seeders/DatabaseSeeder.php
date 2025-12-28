<?php

namespace Database\Seeders;

use App\Models\KategoriInventaris;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => env('USER_NAME', 'HIMAIF'),
            'role' => 'admin',
            'email' => env('USER_EMAIL', 'admin@admin.com'),
            'password' => Hash::make(env('USER_PASSWORD', 'admin123')),
        ]);
        User::factory()->create([
            'name' => 'HIMAKI',
            'role' => 'organisasi',
            'email' => 'himaki@unud.com',
            'password' => Hash::make('himaki123'),
        ]);
        User::factory()->create([
            'name' => 'mangkriisnaa',
            'role' => 'umum',
            'email' => 'mangkriisnaa@example.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}