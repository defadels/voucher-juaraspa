<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriVoucher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriVoucherController extends Controller
{
    public function index(): View
    {
        $kategoris = KategoriVoucher::orderBy('nama_kategori')->get();
        return view('admin.kategori_voucher.index', compact('kategoris'));
    }

    public function create(): View
    {
        return view('admin.kategori_voucher.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
            'prefix' => ['required', 'string', 'size:3', 'uppercase'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        KategoriVoucher::create($validated);

        return redirect()->route('admin.kategori-voucher.index')
            ->with('success', 'Kategori voucher berhasil ditambahkan.');
    }

    public function edit(KategoriVoucher $kategoriVoucher): View
    {
        return view('admin.kategori_voucher.edit', ['kategori' => $kategoriVoucher]);
    }

    public function update(Request $request, KategoriVoucher $kategoriVoucher): RedirectResponse
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
            'prefix' => ['required', 'string', 'size:3', 'uppercase'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $kategoriVoucher->update($validated);

        return redirect()->route('admin.kategori-voucher.index')
            ->with('success', 'Kategori voucher berhasil diperbarui.');
    }

    public function destroy(KategoriVoucher $kategoriVoucher): RedirectResponse
    {
        if ($kategoriVoucher->vouchers()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki voucher.');
        }

        $kategoriVoucher->delete();

        return redirect()->route('admin.kategori-voucher.index')
            ->with('success', 'Kategori voucher berhasil dihapus.');
    }
}
