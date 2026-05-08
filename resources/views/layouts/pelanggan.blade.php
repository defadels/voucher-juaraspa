<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Juara SPA - Portal Voucher Digital Pelanggan">
    <title>@yield('title', 'Beranda') – Portal Pelanggan Juara SPA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-[#f5f5f0] font-sans text-gray-900 flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-[250px] min-w-[250px] bg-[#1a1a1a] text-white flex flex-col h-full overflow-y-auto">
        {{-- Brand --}}
        <div class="px-6 pt-8 pb-6 border-b border-white/10">
            <div class="text-xl font-bold tracking-tight">Juara SPA</div>
            <div class="text-xs text-white/50 mt-0.5">Portal Pelanggan</div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-5 space-y-0.5">
            <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-widest text-white/30">Menu</p>
            <x-pelanggan-nav-link :href="route('pelanggan.beranda')" :active="request()->routeIs('pelanggan.beranda')" icon="home">
                Beranda
            </x-pelanggan-nav-link>
            <x-pelanggan-nav-link :href="route('pelanggan.voucher.index')" :active="request()->routeIs('pelanggan.voucher.index')" icon="ticket">
                Voucher Saya
            </x-pelanggan-nav-link>
            <x-pelanggan-nav-link :href="route('pelanggan.riwayat')" :active="request()->routeIs('pelanggan.riwayat')" icon="clock">
                Riwayat
            </x-pelanggan-nav-link>

            <p class="px-3 mt-5 mb-2 text-[10px] font-semibold uppercase tracking-widest text-white/30">Akun</p>
            <x-pelanggan-nav-link :href="route('pelanggan.profil')" :active="request()->routeIs('pelanggan.profil')" icon="user">
                Profil Saya
            </x-pelanggan-nav-link>
            <x-pelanggan-nav-link :href="route('pelanggan.bantuan')" :active="request()->routeIs('pelanggan.bantuan')" icon="help">
                Bantuan
            </x-pelanggan-nav-link>
        </nav>

        {{-- Logout --}}
        <div class="px-3 py-5 border-t border-white/10">
            <form method="POST" action="{{ route('pelanggan.logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg text-sm text-white/60 hover:text-white hover:bg-white/10 transition-colors">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        {{-- Topbar --}}
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between flex-shrink-0">
            <h1 class="text-lg font-semibold text-gray-900">@yield('page-title', 'Beranda')</h1>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                <div class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm font-semibold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mx-8 mt-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>
