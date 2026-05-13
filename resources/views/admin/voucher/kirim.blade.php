@extends('layouts.admin')
@section('title', 'Kirim Voucher')
@section('page-title', 'Kirim Voucher')

@section('content')
<div class="grid grid-cols-2 gap-6 max-w-4xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-sm font-semibold text-gray-700 mb-5">Form Kirim Voucher</h2>

        @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700">
            @foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('admin.voucher.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Pelanggan</label>
                <select name="pelanggan_id" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
                    <option value="">Pilih pelanggan...</option>
                    @foreach($pelangganList as $p)
                    <option value="{{ $p->id }}" {{ (old('pelanggan_id', request('pelanggan')) == $p->id) ? 'selected' : '' }}>
                        {{ $p->name }} – {{ $p->nomor_telepon }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Kategori Voucher</label>
                <select name="kategori_id" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
                    <option value="">Pilih kategori...</option>
                    @foreach($kategoris as $k)
                    <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Jumlah Voucher</label>
                <input type="number" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" max="50" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Tanggal Terbit</label>
                <input type="date" name="tgl_terbit" value="{{ old('tgl_terbit', today()->format('Y-m-d')) }}" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
            </div>

            <button type="submit" class="w-full bg-gray-900 text-white text-sm font-semibold py-3 rounded-lg hover:bg-gray-800 transition-colors">
                Kirim Voucher
            </button>
        </form>
    </div>

    {{-- <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-sm font-semibold text-gray-700 mb-4">Ringkasan & Info</h2>
        <div class="space-y-3">
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-100 text-sm">
                <ol class="space-y-1.5 text-gray-700 list-decimal list-inside">
                    <li>Pilih pelanggan tujuan</li>
                    <li>Pilih jenis voucher</li>
                    <li>Tentukan jumlah</li>
                    <li>Sistem generate QR Code otomatis</li>
                    <li>Pelanggan lihat di portal mereka</li>
                </ol>
            </div>
            <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                <p class="text-xs text-blue-600">Setiap voucher memiliki kode unik <strong>JPS-XX-XXXX</strong> dengan QR Code tersendiri.</p>
            </div>
            <div class="p-4 bg-amber-50 rounded-lg border border-amber-100">
                <p class="text-xs font-semibold text-amber-700 mb-2">Kategori Tersedia</p>
                @foreach($kategoris as $k)
                <span class="inline-block text-xs bg-amber-100 text-amber-800 rounded px-2 py-0.5 mr-1 mb-1">{{ $k->nama_kategori }}</span>
                @endforeach
            </div>
        </div>
    </div> --}}
</div>
@endsection
