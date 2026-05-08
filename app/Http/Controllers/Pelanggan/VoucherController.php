<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\VoucherUsage;
use Illuminate\View\View;

class VoucherController extends Controller
{
    public function index(): View
    {
        $pelanggan = auth()->user();

        $vouchers = Voucher::with(['kategori', 'usages'])
            ->where('pelanggan_id', $pelanggan->id)
            ->latest()
            ->paginate(20);

        return view('pelanggan.voucher.index', compact('vouchers'));
    }

    public function show(Voucher $voucher): View
    {
        abort_if($voucher->pelanggan_id !== auth()->id(), 403);

        $voucher->load(['kategori', 'pelanggan', 'usages']);

        $qrCodeUrl = asset('storage/'.$voucher->qr_code_path);

        return view('pelanggan.voucher.show', compact('voucher', 'qrCodeUrl'));
    }

    public function riwayat(): View
    {
        $pelanggan = auth()->user();

        $riwayat = VoucherUsage::with(['voucher.kategori'])
            ->whereHas('voucher', fn ($q) => $q->where('pelanggan_id', $pelanggan->id))
            ->latest()
            ->paginate(15);

        return view('pelanggan.riwayat', compact('riwayat'));
    }
}
