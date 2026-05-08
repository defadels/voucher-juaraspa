<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->user() || $request->user()->role !== $role) {
            if ($role === 'admin') {
                return redirect()->route('admin.login')->with('error', 'Akses ditolak. Halaman ini khusus admin.');
            }

            return redirect()->route('pelanggan.login')->with('error', 'Akses ditolak. Silakan login sebagai pelanggan.');
        }

        return $next($request);
    }
}
