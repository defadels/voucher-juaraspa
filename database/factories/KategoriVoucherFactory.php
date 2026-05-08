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

        return [
            'nama_kategori' => fake()->unique()->randomElement($kategoris),
            'deskripsi' => fake()->sentence(8),
        ];
    }
}
