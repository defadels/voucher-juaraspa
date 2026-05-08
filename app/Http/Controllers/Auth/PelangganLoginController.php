<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PelangganLoginController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (auth()->check() && auth()->user()->isPelanggan()) {
            return redirect()->route('pelanggan.beranda');
        }

        return view('auth.pelanggan-login');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginField = filter_var($validated['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'nomor_telepon';

        if (! Auth::attempt([$loginField => $validated['login'], 'password' => $validated['password']], $request->boolean('remember'))) {
            return back()->withErrors([
                'login' => 'Email/nomor telepon atau password salah.',
            ])->onlyInput('login');
        }

        if (! auth()->user()->isPelanggan()) {
            Auth::logout();

            return back()->withErrors([
                'login' => 'Akun ini bukan akun pelanggan.',
            ])->onlyInput('login');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('pelanggan.beranda'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pelanggan.login');
    }
}
