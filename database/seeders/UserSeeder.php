<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@juaraspa.com',
            'nomor_telepon' => '081234567890',
            'password' => Hash::make('password'),
        ]);

        // Pelanggan
        $pelanggan1 = User::factory()->pelanggan()->create([
            'name' => 'Sari Dewi',
            'email' => 'sari@email.com',
            'nomor_telepon' => '081200000001',
            'password' => Hash::make('password'),
        ]);
    }
}
