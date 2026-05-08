<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriVoucher;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUsage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $bulan = $request->integer('bulan', now()->month);
        $tahun = $request->integer('tahun', now()->year);

        $totalPelanggan = User::where('role', 'pelanggan')->count();
        $totalVoucher = Voucher::count();
        $voucherAktif = Voucher::where('status', 'aktif')->count();
        $voucherTerpakai = Voucher::where('status', 'terpakai')->count();

        // Rekap per kategori bulan ini
        $rekapKategori = KategoriVoucher::withCount([
            'vouchers as total_diterbitkan',
            'vouchers as total_terpakai' => fn ($q) => $q->where('status', 'terpakai'),
        ])
            ->get();

        // Pemakaian per hari dalam bulan ini
        $pemakaianBulanIni = VoucherUsage::whereYear('tgl_digunakan', $tahun)
            ->whereMonth('tgl_digunakan', $bulan)
            ->selectRaw('DAY(tgl_digunakan) as hari, COUNT(*) as jumlah')
            ->groupByRaw('DAY(tgl_digunakan)')
            ->orderByRaw('DAY(tgl_digunakan)')
            ->get()
            ->keyBy('hari');

        $bulanOptions = collect(range(1, 12))->map(fn ($m) => [
            'value' => $m,
            'label' => now()->setMonth($m)->locale('id')->isoFormat('MMMM'),
        ]);

        $tahunOptions = collect(range(now()->year - 2, now()->year));

        return view('admin.laporan', compact(
            'totalPelanggan', 'totalVoucher', 'voucherAktif', 'voucherTerpakai',
            'rekapKategori', 'pemakaianBulanIni', 'bulan', 'tahun', 'bulanOptions', 'tahunOptions'
        ));
    }
}
