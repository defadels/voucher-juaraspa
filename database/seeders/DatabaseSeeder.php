<?php

namespace Database\Seeders;

use App\Models\KategoriVoucher;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUsage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

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

        $pelanggan2 = User::factory()->pelanggan()->create([
            'name' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'nomor_telepon' => '081200000002',
            'password' => Hash::make('password'),
        ]);

        $pelanggan3 = User::factory()->pelanggan()->create([
            'name' => 'Deni Pratama',
            'email' => 'deni@email.com',
            'nomor_telepon' => '081200000003',
            'password' => Hash::make('password'),
        ]);

        // Tambah pelanggan lain
        $pelangganLain = User::factory()->pelanggan()->count(5)->create();

        // Kategori Voucher
        $kategoriData = [
            ['nama_kategori' => 'Relaksasi', 'deskripsi' => 'Pijat relaksasi seluruh tubuh'],
            ['nama_kategori' => 'Body Scrub', 'deskripsi' => 'Scrub tubuh dengan bahan alami'],
            ['nama_kategori' => 'Facial', 'deskripsi' => 'Perawatan wajah profesional'],
            ['nama_kategori' => 'Manicure', 'deskripsi' => 'Perawatan kuku tangan'],
            ['nama_kategori' => 'Pedicure', 'deskripsi' => 'Perawatan kuku kaki'],
        ];

        $kategoris = collect($kategoriData)->map(fn ($k) => KategoriVoucher::create($k));

        // Buat voucher untuk pelanggan utama
        $allPelanggan = collect([$pelanggan1, $pelanggan2, $pelanggan3])->merge($pelangganLain);

        foreach ($allPelanggan as $pelanggan) {
            $jumlah = rand(2, 5);
            for ($i = 1; $i <= $jumlah; $i++) {
                $kategori = $kategoris->random();
                $kode = 'JPS-'.str_pad($kategori->id, 2, '0', STR_PAD_LEFT).'-'.str_pad($pelanggan->id * 10 + $i, 4, '0', STR_PAD_LEFT);
                $status = ($i <= 2) ? 'terpakai' : 'aktif';

                $voucher = Voucher::create([
                    'kode_voucher' => $kode,
                    'qr_code_path' => 'qrcodes/'.$kode.'.svg',
                    'tgl_terbit' => now()->subDays(rand(1, 90))->format('Y-m-d'),
                    'pelanggan_id' => $pelanggan->id,
                    'admin_id' => $admin->id,
                    'kategori_id' => $kategori->id,
                    'status' => $status,
                ]);

                if ($status === 'terpakai') {
                    VoucherUsage::create([
                        'voucher_id' => $voucher->id,
                        'tgl_digunakan' => now()->subDays(rand(1, 30))->format('Y-m-d'),
                        'keterangan' => 'Digunakan di Juara SPA Medan',
                    ]);
                }
            }
        }
    }
}
