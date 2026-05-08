@extends('layouts.admin')
@section('title', 'Buat Akun Pelanggan')
@section('page-title', 'Buat Akun Pelanggan')

@section('content')
<div class="max-w-xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-base font-semibold text-gray-800 mb-5">Data Pelanggan Baru</h2>

        @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700 space-y-1">
            @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('admin.pelanggan.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">No. Telepon</label>
                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="08xxxxxxxxxx" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Password Awal</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
                <p class="mt-1 text-xs text-gray-400">Minimal 8 karakter. Beritahu pelanggan password ini.</p>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-gray-900 text-white text-sm font-medium px-5 py-2.5 rounded-lg hover:bg-gray-800 transition-colors">
                    Buat Akun
                </button>
                <a href="{{ route('admin.pelanggan.index') }}" class="text-sm font-medium text-gray-600 px-5 py-2.5 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
