@extends('layouts.pelanggan')
@section('title', 'Detail Voucher')
@section('page-title', 'Detail Voucher')

@section('content')
<div class="flex items-center gap-2 mb-6 text-sm text-gray-500">
    <a href="{{ route('pelanggan.voucher.index') }}" class="hover:text-gray-900">Voucher Saya</a>
    <span>/</span>
    <span class="text-gray-900 font-mono">{{ $voucher->kode_voucher }}</span>
</div>

<div class="max-w-md mx-auto relative">
    {{-- Card Tiket --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden relative">

        {{-- Header Kategori --}}
        <div class="bg-gray-900 text-white text-center py-4 px-6 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMSI+PC9yZWN0Pgo8cGF0aCBkPSJNMCAwTDggOFpNOCAwTDAgOFoiIHN0cm9rZT0iI2ZmZiIgc3Ryb2tlLW9wYWNpdHk9IjAuNCIgc3Ryb2tlLXdpZHRoPSIxIj48L3BhdGg+Cjwvc3ZnPg==')]"></div>
            <h2 class="text-lg font-bold relative z-10">{{ $voucher->kategori?->nama_kategori }}</h2>
            <p class="text-xs text-white/70 relative z-10 mt-0.5">Berlaku untuk 1x pemakaian di Juara SPA</p>
        </div>

        {{-- Divider "Gigi" Tiket --}}
        <div class="flex justify-between items-center -mt-3 relative z-20">
            <div class="w-6 h-6 bg-[#f5f5f0] rounded-full border-r border-gray-200 -ml-3"></div>
            <div class="flex-1 border-t-2 border-dashed border-gray-200 h-0 mx-2"></div>
            <div class="w-6 h-6 bg-[#f5f5f0] rounded-full border-l border-gray-200 -mr-3"></div>
        </div>

        {{-- Main QR --}}
        <div class="p-8 text-center relative">
            @if($voucher->status === 'terpakai')
            <div class="absolute inset-0 z-10 flex items-center justify-center bg-white/80 backdrop-blur-[1px]">
                <div class="transform -rotate-12 border-4 border-red-500 text-red-500 text-2xl font-bold uppercase tracking-widest px-6 py-2 rounded-lg shadow-sm">
                    Sudah Terpakai
                </div>
            </div>
            @endif

            <div class="inline-block p-4 border-2 border-gray-100 rounded-2xl mb-5 bg-white shadow-sm">
                <div class="w-48 h-48">
                    {!! file_get_contents(public_path('storage/' . $voucher->qr_code_path)) !!}
                </div>
            </div>

            <div class="bg-gray-50 py-3 px-4 rounded-xl inline-block border border-gray-100 mb-6">
                <p class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold mb-1">Kode Voucher</p>
                <p class="text-xl font-mono font-bold text-gray-900 tracking-wider">{{ $voucher->kode_voucher }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 text-left border-t border-gray-100 pt-6">
                <div>
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1">Nama Pelanggan</p>
                    <p class="text-sm font-medium text-gray-900">{{ $voucher->pelanggan?->name }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1">Diterbitkan</p>
                    <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($voucher->tgl_terbit)->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Footer Info --}}
        <div class="bg-gray-50 border-t border-gray-100 px-6 py-4 text-center">
            @if($voucher->status === 'aktif')
                <p class="text-xs text-gray-500">Tunjukkan QR Code ini kepada kasir Juara SPA untuk discan.</p>
            @else
                <p class="text-xs text-gray-500">Digunakan pada: <span class="font-medium">{{ $voucher->usages->last()?->tgl_digunakan?->format('d/m/Y') }}</span></p>
            @endif
        </div>
    </div>
</div>
@endsection
