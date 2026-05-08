<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function index(): View
    {
        $pelanggan = auth()->user();

        return view('pelanggan.profil', compact('pelanggan'));
    }

    public function update(Request $request): RedirectResponse
    {
        $pelanggan = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nomor_telepon' => ['required', 'string', 'max:20'],
        ]);

        $pelanggan->update($validated);

        return redirect()->route('pelanggan.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('pelanggan.profil')->with('success', 'Password berhasil diubah.');
    }
}
