<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUsage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        $totalVoucher = Voucher::count();
        $voucherAktif = Voucher::where('status', 'aktif')->count();
        $voucherTerpakai = Voucher::where('status', 'terpakai')->count();

        // Data grafik 7 hari terakhir
        $pemakaian7Hari = collect(range(6, 0))->map(function (int $daysAgo) {
            $date = now()->subDays($daysAgo)->format('Y-m-d');

            return [
                'label' => now()->subDays($daysAgo)->locale('id')->isoFormat('ddd'),
                'count' => VoucherUsage::whereDate('tgl_digunakan', $date)->count(),
            ];
        });

        // Aktivitas terbaru
        $aktivitasTerbaru = VoucherUsage::with(['voucher.pelanggan', 'voucher.kategori'])
            ->latest()
            ->limit(5)
            ->get();

        // Pelanggan aktif (memiliki voucher aktif)
        $pelangganAktif = User::where('role', 'pelanggan')
            ->withCount(['voucherSebagaiPelanggan as voucher_aktif_count' => fn ($q) => $q->where('status', 'aktif')])
            ->withCount(['voucherSebagaiPelanggan as voucher_terpakai_count' => fn ($q) => $q->where('status', 'terpakai')])
            ->having('voucher_aktif_count', '>', 0)
            ->orderByDesc('voucher_aktif_count')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPelanggan', 'totalVoucher', 'voucherAktif', 'voucherTerpakai',
            'pemakaian7Hari', 'aktivitasTerbaru', 'pelangganAktif'
        ));
    }
}
