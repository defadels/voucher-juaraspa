@extends('layouts.pelanggan')
@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')
<div class="grid grid-cols-2 gap-6 max-w-4xl">
    {{-- Update Data Diri --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
        <h2 class="text-base font-semibold text-gray-800 mb-5 border-b border-gray-100 pb-3">Data Diri</h2>

        @if(session('success'))
            @if(str_contains(session('success'), 'Profil'))
            <div class="mb-5 p-3 bg-green-50 text-green-700 border border-green-200 text-sm rounded-lg flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
            @endif
        @endif

        <form method="POST" action="{{ route('pelanggan.profil.update') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $pelanggan->name) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 focus:bg-white transition-colors">
                @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Email</label>
                <input type="email" value="{{ $pelanggan->email }}" disabled
                    class="w-full px-4 py-2.5 bg-gray-100 border border-gray-200 rounded-lg text-sm text-gray-500 cursor-not-allowed">
                <p class="text-[10px] text-gray-400 mt-1.5 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Email dikelola oleh Admin. Hubungi Admin untuk mengubah.
                </p>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">No. Telepon / WhatsApp</label>
                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $pelanggan->nomor_telepon) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 focus:bg-white transition-colors">
                @error('nomor_telepon')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-gray-900 text-white text-sm font-medium py-3 rounded-lg hover:bg-gray-800 transition-colors shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- Update Password --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm h-fit">
        <h2 class="text-base font-semibold text-gray-800 mb-5 border-b border-gray-100 pb-3">Ganti Password</h2>

        @if(session('success'))
            @if(str_contains(session('success'), 'Password'))
            <div class="mb-5 p-3 bg-green-50 text-green-700 border border-green-200 text-sm rounded-lg flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
            @endif
        @endif

        <form method="POST" action="{{ route('pelanggan.profil.password') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Password Saat Ini</label>
                <input type="password" name="current_password" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 focus:bg-white transition-colors">
                @error('current_password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Password Baru</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 focus:bg-white transition-colors">
                <p class="text-[10px] text-gray-400 mt-1.5">Minimal 8 karakter.</p>
                @error('password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 focus:bg-white transition-colors">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-white border border-gray-300 text-gray-900 text-sm font-medium py-3 rounded-lg hover:bg-gray-50 transition-colors shadow-sm">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
