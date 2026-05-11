<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login Admin Panel – Juara SPA Sistem Voucher Digital">
    <title>Login Admin – Juara SPA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-[#f5f5f0] flex flex-col md:flex-row h-screen">

    {{-- LEFT SIDEBAR (Hidden on mobile) --}}
    <aside class="hidden md:flex w-[250px] min-w-[250px] bg-[#1a1a1a] text-white flex-col justify-between py-8 px-6">
        <div>

            <img src="{{ asset('logo.png') }}" alt="Logo Juara SPA"
                class="w-32 h-auto mb-8 rounded-full shadow-lg border-2 border-white/20">

            <div class="mb-12">
                <h1 class="text-xl font-bold tracking-tight">Juara SPA</h1>
                <p class="text-xs text-white/40 mt-1 leading-relaxed">Admin Panel · Sistem Voucher Digital</p>
            </div>

            <div class="space-y-5">
                @foreach ([['icon' => 'lock', 'title' => 'Akses Aman', 'desc' => 'Login khusus admin terpisah dari pelanggan'], ['icon' => 'qr', 'title' => 'Kelola Voucher', 'desc' => 'Terbitkan & pantau QR Code voucher pelanggan'], ['icon' => 'chart', 'title' => 'Laporan Lengkap', 'desc' => 'Monitor pemakaian voucher secara real-time']] as $item)
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            @if ($item['icon'] === 'lock')
                                <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            @elseif($item['icon'] === 'qr')
                                <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-white">{{ $item['title'] }}</div>
                            <div class="text-xs text-white/40 mt-0.5 leading-relaxed">{{ $item['desc'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="text-xs text-white/25">&copy; {{ now()->year }} Juara SPA · Medan</div>
    </aside>

    {{-- RIGHT FORM --}}
    <main class="flex-1 flex items-center justify-center p-6 sm:p-12 overflow-y-auto">
        <div class="w-full max-w-md">
            {{-- Mobile Branding --}}

            <div class="md:hidden flex items-center justify-center gap-3">
                <img src="{{ asset('logo.png') }}" alt="Logo Juara SPA"
                    class="w-32 h-auto mb-8 rounded-full shadow-lg border-2 border-white/20">
            </div>

            <div class="md:hidden text-center mb-8">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Juara SPA</h1>
                <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest font-semibold">Admin Panel</p>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-900">Masuk sebagai Admin</h2>
                <p class="text-sm text-gray-500 mt-1">Hanya untuk staf dan pengelola Juara SPA</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5"
                        for="email">
                        Email Admin
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        placeholder="admin@juaraspa.com" required autofocus
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-colors">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5"
                        for="password">
                        Password
                    </label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-colors">
                </div>

                <button type="submit"
                    class="w-full py-3 bg-gray-900 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 active:scale-[0.99] transition-all duration-150">
                    Masuk ke Panel Admin
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-gray-500">
                Pelanggan?
                <a href="{{ route('pelanggan.login') }}"
                    class="underline font-medium text-gray-700 hover:text-gray-900">
                    Login di portal pelanggan
                </a>
            </p>
        </div>
    </main>
</body>

</html>
