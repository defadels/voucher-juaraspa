<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriVoucher;
use App\Models\User;
use App\Models\Voucher;
use App\Models\VoucherUsage;
use App\Services\QrCodeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VoucherController extends Controller
{
    public function __construct(public QrCodeService $qrCodeService) {}

    public function index(Request $request): View
    {
        $query = Voucher::with(['pelanggan', 'kategori', 'usages']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_voucher', 'like', "%{$search}%")
                    ->orWhereHas('pelanggan', fn ($p) => $p->where('name', 'like', "%{$search}%"));
            });
        }

        $vouchers = $query->latest()->paginate(20)->withQueryString();
        $kategoris = KategoriVoucher::all();

        return view('admin.voucher.index', compact('vouchers', 'kategoris'));
    }

    public function kirim(): View
    {
        $pelangganList = User::where('role', 'pelanggan')->orderBy('name')->get();
        $kategoris = KategoriVoucher::orderBy('nama_kategori')->get();

        return view('admin.voucher.kirim', compact('pelangganList', 'kategoris'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pelanggan_id' => ['required', 'exists:users,id'],
            'kategori_id' => ['required', 'exists:kategori_voucher,id'],
            'jumlah' => ['required', 'integer', 'min:1', 'max:50'],
            'tgl_terbit' => ['required', 'date'],
        ]);

        $admin = auth()->user();
        $kategori = KategoriVoucher::findOrFail($validated['kategori_id']);
        $jumlahBaru = (int) $validated['jumlah'];

        for ($i = 0; $i < $jumlahBaru; $i++) {
            $urutan = Voucher::where('kategori_id', $kategori->id)->count() + 1;
            $kode = 'JPS-'.str_pad($kategori->id, 2, '0', STR_PAD_LEFT).'-'.str_pad($urutan, 4, '0', STR_PAD_LEFT);

            $qrPath = $this->qrCodeService->generate($kode);

            Voucher::create([
                'kode_voucher' => $kode,
                'qr_code_path' => $qrPath,
                'tgl_terbit' => $validated['tgl_terbit'],
                'pelanggan_id' => $validated['pelanggan_id'],
                'admin_id' => $admin->id,
                'kategori_id' => $kategori->id,
                'status' => 'aktif',
            ]);
        }

        return redirect()->route('admin.voucher.index')
            ->with('success', $jumlahBaru.' voucher berhasil dikirim.');
    }

    public function riwayat(Request $request): View
    {
        $query = VoucherUsage::with(['voucher.pelanggan', 'voucher.kategori'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('voucher', function ($q) use ($search) {
                $q->where('kode_voucher', 'like', "%{$search}%")
                    ->orWhereHas('pelanggan', fn ($p) => $p->where('name', 'like', "%{$search}%"));
            });
        }

        $riwayat = $query->paginate(20)->withQueryString();

        return view('admin.voucher.riwayat', compact('riwayat'));
    }
}
