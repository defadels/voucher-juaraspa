<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@juaraspa.com',
            'nomor_telepon' => '081234567890',
            'password' => Hash::make('password'),
        ]);

        // Pelanggan
        User::factory()->pelanggan()->create([
            'name' => 'Sari Dewi',
            'email' => 'sari@email.com',
            'nomor_telepon' => '081200000001',
            'password' => Hash::make('password'),
        ]);
    }
}
