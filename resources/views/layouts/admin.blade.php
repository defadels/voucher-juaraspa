<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Juara SPA - Admin Panel Sistem Voucher Digital">
    <title>@yield('title', 'Dashboard') – Admin Juara SPA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-[#F6EFDE] text-[#2A2421] flex h-screen overflow-hidden" style="font-family: 'Lato', sans-serif;" x-data="{ sidebarOpen: false }">

    {{-- OVERLAY FOR MOBILE --}}
    <div x-show="sidebarOpen" 
         x-on:click="sidebarOpen = false" 
         class="fixed inset-0 bg-black/50 z-40 lg:hidden" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak>
    </div>

    {{-- SIDEBAR --}}
    <aside class="fixed inset-y-0 left-0 z-50 w-[250px] min-w-[250px] bg-[#2A2421] text-[#F6EFDE] flex flex-col h-full overflow-y-auto transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-auto"
           x-bind:class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
        {{-- Brand --}}
        <div class="px-6 pt-8 pb-6 border-b border-[#C5A059]/30 flex items-center gap-3">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full border border-[#C5A059]/30 shadow-sm">
            <div>
                <div class="text-lg font-bold tracking-widest uppercase" style="font-family: 'Lusitana', Georgia, serif;">Juara SPA</div>
                <div class="text-[10px] tracking-widest uppercase text-[#C5A059]/70 mt-0.5">Admin Panel</div>
            </div>
            <button x-on:click="sidebarOpen = false" class="lg:hidden text-[#C5A059]/60 hover:text-[#C5A059]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-5 space-y-0.5">
            <p class="px-3 mb-2 text-[10px] font-semibold uppercase tracking-widest text-[#C5A059]/50">Utama</p>
            <x-admin-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" icon="grid">
                Dashboard
            </x-admin-nav-link>

            <p class="px-3 mt-5 mb-2 text-[10px] font-semibold uppercase tracking-widest text-[#C5A059]/50">Pelanggan</p>
            <x-admin-nav-link :href="route('admin.pelanggan.index')" :active="request()->routeIs('admin.pelanggan.*')" icon="user">
                Akun Pelanggan
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('admin.pelanggan.create')" :active="request()->routeIs('admin.pelanggan.create')" icon="user-plus">
                Buat Akun
            </x-admin-nav-link>

            <p class="px-3 mt-5 mb-2 text-[10px] font-semibold uppercase tracking-widest text-[#C5A059]/50">Voucher</p>
            <x-admin-nav-link :href="route('admin.scan')" :active="request()->routeIs('admin.scan')" icon="qrcode">
                Scan Voucher
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('admin.voucher.kirim')" :active="request()->routeIs('admin.voucher.kirim')" icon="send">
                Kirim Voucher
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('admin.voucher.index')" :active="request()->routeIs('admin.voucher.index')" icon="ticket">
                Semua Voucher
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('admin.kategori-voucher.index')" :active="request()->routeIs('admin.kategori-voucher.*')" icon="grid">
                Kategori Voucher
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('admin.voucher.riwayat')" :active="request()->routeIs('admin.voucher.riwayat')" icon="clock">
                Riwayat Pakai
            </x-admin-nav-link>

            <p class="px-3 mt-5 mb-2 text-[10px] font-semibold uppercase tracking-widest text-[#C5A059]/50">Lainnya</p>
            <x-admin-nav-link :href="route('admin.laporan')" :active="request()->routeIs('admin.laporan')" icon="chart">
                Laporan
            </x-admin-nav-link>
            <x-admin-nav-link :href="route('admin.pengaturan')" :active="request()->routeIs('admin.pengaturan')" icon="settings">
                Pengaturan
            </x-admin-nav-link>
        </nav>

        {{-- Logout --}}
        <div class="px-3 py-5 border-t border-[#C5A059]/20">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-3 py-2.5 rounded-lg text-sm text-[#C5A059]/60 hover:text-[#F6EFDE] hover:bg-[#C5A059]/20 transition-colors">
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
        <header class="bg-[#FAF6ED] border-b border-[#E8DFC9] px-4 lg:px-8 py-4 flex items-center justify-between flex-shrink-0">
            <div class="flex items-center gap-4">
                <button x-on:click="sidebarOpen = true" class="p-2 -ml-2 text-[#9E7B3B] lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-base lg:text-lg font-semibold text-[#2A2421] truncate">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-[#635752] hidden sm:inline-block">{{ auth()->user()->name }}</span>
                <div class="w-8 h-8 rounded-full bg-[#2A2421] text-[#F6EFDE] flex items-center justify-center text-sm font-semibold border border-[#C5A059]/30">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mx-4 lg:mx-8 mt-4 p-3 bg-[#F6EFDE] border border-[#C5A059]/40 text-[#2A2421] rounded-lg text-sm flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0 text-[#9E7B3B]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mx-4 lg:mx-8 mt-4 p-3 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-4 lg:p-8 bg-[#F6EFDE]">
            @yield('content')
        </main>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>
