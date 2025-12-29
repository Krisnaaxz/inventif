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

        $user = [
            [
            'name' => env('USER_NAME', 'HIMAIF'),
            'role' => 'admin',
            'email' => env('USER_EMAIL', 'admin@admin.com'),
            'password' => Hash::make(env('USER_PASSWORD', 'admin123')),
            ],
            [
            'name' => 'HIMAKI',
            'role' => 'organisasi',
            'email' => 'himaki@unud.com',
            'password' => Hash::make('himaki123'),
            ],
            [
            'name' => 'HIMAFI',
            'role' => 'organisasi',
            'email' => 'himafi@unud.com',
            'password' => Hash::make('himafi123'),
            ],
            [
            'name' => 'HIMABIO',
            'role' => 'organisasi',
            'email' => 'himabio@unud.com',
            'password' => Hash::make('himabio123'),
            ],
            [
            'name' => 'HIMATIKA',
            'role' => 'organisasi',
            'email' => 'himatika@unud.com',
            'password' => Hash::make('himatika123'),
            ],
            [
            'name' => 'HIMAFARMA',
            'role' => 'organisasi',
            'email' => 'himafarma@unud.com',
            'password' => Hash::make('himafarma123'),
            ],
            [
            'name' => 'BEM FMIPA',
            'role' => 'organisasi',
            'email' => 'bemfmipa@unud.com',
            'password' => Hash::make('bemfmipa123'),
            ],
            [
            'name' => 'DPM FMIPA',
            'role' => 'organisasi',
            'email' => 'dpmfmipa@unud.com',
            'password' => Hash::make('dpmfmipa123'),
            ],
            [
            'name' => 'mangkriisnaa',
            'role' => 'umum',
            'email' => 'mangkriisnaa@unud.com',
            'password' => Hash::make('12345678'),
            ],
        ];
        User::insert($user);

        $kategori = [
            [
                'nama_kategori' => 'Kabel'
            ],
            [
                'nama_kategori' => 'Adapter'
            ],
            [
                'nama_kategori' => 'Sound'
            ],
            [
                'nama_kategori' => 'Microphone'
            ],
            [
                'nama_kategori' => 'Proyektor'
            ],
            [
                'nama_kategori' => 'Perkakas'
            ],
            [
                'nama_kategori' => 'Alat Kebersihan'
            ]
        ];
        KategoriInventaris::insert($kategori);
    }
}