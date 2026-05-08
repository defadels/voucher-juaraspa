<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PelangganController extends Controller
{
    public function index(): View
    {
        $pelangganList = User::where('role', 'pelanggan')
            ->withCount(['voucherSebagaiPelanggan as voucher_aktif' => fn ($q) => $q->where('status', 'aktif')])
            ->withCount(['voucherSebagaiPelanggan as voucher_terpakai' => fn ($q) => $q->where('status', 'terpakai')])
            ->latest()
            ->paginate(15);

        return view('admin.pelanggan.index', compact('pelangganList'));
    }

    public function create(): View
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'nomor_telepon' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'role' => 'pelanggan',
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Akun pelanggan '.$validated['name'].' berhasil dibuat.');
    }

    public function show(User $pelanggan): View
    {
        abort_if($pelanggan->role !== 'pelanggan', 404);

        $pelanggan->load([
            'voucherSebagaiPelanggan.kategori',
            'voucherSebagaiPelanggan.usages',
        ]);

        $riwayatPemakaian = $pelanggan->voucherSebagaiPelanggan
            ->flatMap(fn ($v) => $v->usages)
            ->sortByDesc('created_at');

        return view('admin.pelanggan.show', compact('pelanggan', 'riwayatPemakaian'));
    }

    public function resetPassword(Request $request, User $pelanggan): RedirectResponse
    {
        abort_if($pelanggan->role !== 'pelanggan', 404);

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $pelanggan->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.pelanggan.show', $pelanggan)
            ->with('success', 'Password berhasil direset.');
    }
}
