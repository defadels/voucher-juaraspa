<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\VoucherUsage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScanController extends Controller
{
    public function index(): View
    {
        $logHariIni = VoucherUsage::with(['voucher.pelanggan', 'voucher.kategori'])
            ->whereDate('created_at', now()->toDateString())
            ->latest()
            ->paginate(10);

        return view('admin.voucher.scan', compact('logHariIni'));
    }

    public function validasi(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'kode_voucher' => ['required', 'string'],
        ]);

        $kode = trim($validated['kode_voucher']);
        $voucher = Voucher::with(['pelanggan', 'kategori', 'usages'])
            ->where('kode_voucher', $kode)
            ->first();

        if (! $voucher) {
            return response()->json([
                'state' => 'tidak_ditemukan',
                'pesan' => 'Voucher tidak ditemukan. Kode tidak valid.',
            ]);
        }

        if ($voucher->status === 'terpakai') {
            return response()->json([
                'state' => 'sudah_terpakai',
                'pesan' => 'Voucher ini sudah pernah digunakan.',
                'voucher' => [
                    'kode' => $voucher->kode_voucher,
                    'pelanggan' => $voucher->pelanggan->name,
                    'kategori' => $voucher->kategori->nama_kategori,
                    'tgl_digunakan' => $voucher->usages->last()?->tgl_digunakan?->format('d/m/Y'),
                ],
            ]);
        }

        return response()->json([
            'state' => 'valid',
            'pesan' => 'Voucher valid. Siap untuk digunakan.',
            'voucher' => [
                'id' => $voucher->id,
                'kode' => $voucher->kode_voucher,
                'pelanggan' => $voucher->pelanggan->name,
                'nomor_telepon' => $voucher->pelanggan->nomor_telepon,
                'kategori' => $voucher->kategori->nama_kategori,
                'tgl_terbit' => $voucher->tgl_terbit,
            ],
        ]);
    }

    public function gunakan(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'voucher_id' => ['required', 'exists:voucher,id'],
            'keterangan' => ['required', 'string', 'max:255'],
        ]);

        $voucher = Voucher::findOrFail($validated['voucher_id']);

        if ($voucher->status === 'terpakai') {
            return response()->json(['state' => 'sudah_terpakai', 'pesan' => 'Voucher sudah terpakai.'], 422);
        }

        VoucherUsage::create([
            'voucher_id' => $voucher->id,
            'tgl_digunakan' => now()->format('Y-m-d'),
            'keterangan' => $validated['keterangan'],
        ]);

        $voucher->update(['status' => 'terpakai']);

        return response()->json([
            'state' => 'berhasil',
            'pesan' => 'Voucher berhasil digunakan.',
        ]);
    }
}
