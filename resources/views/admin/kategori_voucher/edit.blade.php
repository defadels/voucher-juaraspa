@extends('layouts.admin')
@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori Voucher')

@section('content')
<div class="max-w-xl">
    <a href="{{ route('admin.kategori-voucher.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-900 mb-6 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali ke Daftar
    </a>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <form action="{{ route('admin.kategori-voucher.update', $kategori) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')
            
            <div>
                <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" required value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors @error('nama_kategori') border-red-500 @enderror">
                @error('nama_kategori') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="prefix" class="block text-sm font-medium text-gray-700 mb-1">Prefix Kode (3 Karakter)</label>
                <input type="text" name="prefix" id="prefix" required maxlength="3" value="{{ old('prefix', $kategori->prefix) }}"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm font-mono focus:outline-none focus:border-gray-400 transition-colors uppercase @error('prefix') border-red-500 @enderror">
                <p class="mt-1.5 text-[10px] text-gray-400 uppercase tracking-wider">3 karakter awal untuk generate kode voucher otomatis.</p>
                @error('prefix') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-gray-900 text-white font-medium py-2.5 rounded-lg hover:bg-gray-800 transition-all shadow-sm">
                    Perbarui Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
