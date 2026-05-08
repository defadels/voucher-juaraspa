<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PengaturanController extends Controller
{
    public function index(): View
    {
        $admin = auth()->user();

        return view('admin.pengaturan', compact('admin'));
    }

    public function updateProfil(Request $request): RedirectResponse
    {
        $admin = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($admin->id)],
            'nomor_telepon' => ['required', 'string', 'max:20'],
        ]);

        $admin->update($validated);

        return redirect()->route('admin.pengaturan')->with('success', 'Profil berhasil diperbarui.');
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

        return redirect()->route('admin.pengaturan')->with('success', 'Password berhasil diubah.');
    }
}
