<?php

namespace Database\Factories;

use App\Models\KategoriVoucher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KategoriVoucher>
 */
class KategoriVoucherFactory extends Factory
{
    /** @return array<string, mixed> */
    public function definition(): array
    {
        $kategoris = ['Relaksasi', 'Body Scrub', 'Facial', 'Manicure', 'Pedicure', 'Hot Stone', 'Aromaterapi', 'Deep Tissue'];
        $name = fake()->unique()->randomElement($kategoris);

        return [
            'nama_kategori' => $name,
            'prefix' => strtoupper(substr(str_replace(' ', '', $name), 0, 3)),
            'deskripsi' => fake()->sentence(8),
        ];
    }
}
