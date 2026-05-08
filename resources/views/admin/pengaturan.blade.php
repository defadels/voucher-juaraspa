@extends('layouts.admin')
@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Sistem')

@section('content')
<div class="grid grid-cols-2 gap-6 max-w-4xl">
    {{-- Profil Admin --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-base font-semibold text-gray-800 mb-5">Profil Admin</h2>

        @if(session('success_profil'))
            <div class="mb-4 p-3 bg-green-50 text-green-700 text-sm rounded-lg">{{ session('success_profil') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.pengaturan.profil') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $admin->name) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
                @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', $admin->email) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
                @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">No. Telepon</label>
                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $admin->nomor_telepon) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
                @error('nomor_telepon')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="bg-gray-900 text-white text-sm font-medium px-5 py-2.5 rounded-lg hover:bg-gray-800 transition-colors">
                Simpan Profil
            </button>
        </form>
    </div>

    {{-- Keamanan --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-base font-semibold text-gray-800 mb-5">Keamanan Akun</h2>

        @if(session('success_password'))
            <div class="mb-4 p-3 bg-green-50 text-green-700 text-sm rounded-lg">{{ session('success_password') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.pengaturan.password') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Password Saat Ini</label>
                <input type="password" name="current_password" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
                @error('current_password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Password Baru</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
                @error('password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
            </div>

            <button type="submit" class="bg-gray-900 text-white text-sm font-medium px-5 py-2.5 rounded-lg hover:bg-gray-800 transition-colors">
                Ubah Password
            </button>
        </form>
    </div>
</div>
@endsection
