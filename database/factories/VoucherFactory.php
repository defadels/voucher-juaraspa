<?php

namespace Database\Factories;

use App\Models\KategoriVoucher;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Voucher>
 */
class VoucherFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        $admin = User::where('role', 'admin')->inRandomOrder()->first()
            ?? User::factory()->create(['role' => 'admin']);

        $pelanggan = User::where('role', 'pelanggan')->inRandomOrder()->first()
            ?? User::factory()->create(['role' => 'pelanggan']);

        $kategori = KategoriVoucher::inRandomOrder()->first()
            ?? KategoriVoucher::factory()->create();

        $kode = 'JPS-'.str_pad($kategori->id, 2, '0', STR_PAD_LEFT).'-'.str_pad(fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT);

        return [
            'kode_voucher' => $kode,
            'qr_code_path' => 'qrcodes/'.$kode.'.svg',
            'tgl_terbit' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'pelanggan_id' => $pelanggan->id,
            'admin_id' => $admin->id,
            'kategori_id' => $kategori->id,
            'status' => fake()->randomElement(['aktif', 'aktif', 'aktif', 'terpakai']),
        ];
    }

    public function aktif(): static
    {
        return $this->state(fn (array $attributes) => ['status' => 'aktif']);
    }

    public function terpakai(): static
    {
        return $this->state(fn (array $attributes) => ['status' => 'terpakai']);
    }
}
