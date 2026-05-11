<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login Portal Pelanggan – Juara SPA Voucher Digital">
    <title>Login Pelanggan – Juara SPA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-[#f5f5f0] flex flex-col md:flex-row h-screen">

    {{-- LEFT SIDEBAR (Hidden on mobile) --}}
    <aside
        class="hidden md:flex w-[250px] min-w-[250px] bg-[#1a1a1a] text-white flex flex-col justify-between py-8 px-6">
        <div>
            <img src="{{ asset('logo.png') }}" alt="Logo Juara SPA"
                class="w-32 h-auto mb-8 rounded-full shadow-lg border-2 border-white/20">

            <div class="mb-12">
                <h1 class="text-xl font-bold tracking-tight">Juara SPA</h1>
                <p class="text-xs text-white/40 mt-1 leading-relaxed">Portal Voucher Digital Pelanggan</p>
            </div>

            <div class="space-y-5">
                @foreach ([['icon' => 'qr', 'title' => 'Voucher Digital Aman', 'desc' => 'Tersimpan di smartphone, tidak hilang atau rusak'], ['icon' => 'mail', 'title' => 'QR Code Unik', 'desc' => 'Setiap voucher tidak bisa dipalsukan'], ['icon' => 'clock', 'title' => 'Riwayat Lengkap', 'desc' => 'Pantau semua voucher aktif dan terpakai']] as $item)
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            @if ($item['icon'] === 'qr')
                                <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                            @elseif($item['icon'] === 'mail')
                                <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest font-semibold">Portal Pelanggan</p>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-900">Masuk ke Akun Anda</h2>
                <p class="text-sm text-gray-500 mt-1">Gunakan email dan password yang diberikan oleh Juara SPA</p>
            </div>

            {{-- Info box --}}
            <div class="mb-5 p-4 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-800">
                <div class="flex items-start gap-2">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                    <span><strong>Informasi</strong><br>Akun dibuat oleh admin Juara SPA. Belum punya akun? Hubungi
                        Juara SPA di <strong>0853-6620-6336</strong></span>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('pelanggan.login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5"
                        for="login">
                        Email / No. Telepon
                    </label>
                    <input id="login" type="text" name="login" value="{{ old('login') }}"
                        placeholder="Masukkan email atau no. telepon" required autofocus
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-colors">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5"
                        for="password">
                        Password
                    </label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-colors">
                    <p class="mt-1.5 text-right text-xs text-gray-400">
                        <span class="cursor-default">Lupa password? Hubungi Juara SPA</span>
                    </p>
                </div>

                <button type="submit"
                    class="w-full py-3 bg-gray-900 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 active:scale-[0.99] transition-all duration-150">
                    Masuk
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-gray-500">
                Admin?
                <a href="{{ route('admin.login') }}" class="underline font-medium text-gray-700 hover:text-gray-900">
                    Login ke panel admin
                </a>
            </p>
        </div>
    </main>
</body>

</html>
