<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $pelanggan = auth()->user();

        $pelanggan->load(['voucherSebagaiPelanggan.kategori']);

        $voucherAktif = $pelanggan->voucherSebagaiPelanggan->where('status', 'aktif');
        $voucherTerpakai = $pelanggan->voucherSebagaiPelanggan->where('status', 'terpakai');
        $voucherExpired = collect(); // belum ada fitur expired di skema ini

        // Notifikasi (voucher terbaru diterima)
        $notifikasi = $pelanggan->voucherSebagaiPelanggan
            ->sortByDesc('created_at')
            ->take(5)
            ->map(function ($voucher) {
                return [
                    'tipe' => 'diterima',
                    'pesan' => count($voucher->kategori ? [$voucher] : []).' voucher baru diterima dari Juara SPA',
                    'waktu' => $voucher->created_at->diffForHumans(),
                    'aktif' => true,
                ];
            })
            ->unique('pesan')
            ->values()
            ->take(3);

        return view('pelanggan.beranda', compact('pelanggan', 'voucherAktif', 'voucherTerpakai', 'voucherExpired', 'notifikasi'));
    }
}
