@extends('layouts.pelanggan')
@section('title', 'Voucher Saya')
@section('page-title', 'Voucher Saya')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <p class="text-sm text-gray-500">Menampilkan {{ $vouchers->total() }} voucher</p>
    <div class="flex gap-2">
        <span class="w-3 h-3 rounded-full bg-white border border-gray-300 inline-block mt-1"></span> <span class="text-xs text-gray-500">Aktif</span>
        <span class="w-3 h-3 rounded-full bg-gray-100 border border-gray-200 inline-block mt-1 ml-3"></span> <span class="text-xs text-gray-500">Terpakai</span>
    </div>
</div>

<div class="grid grid-cols-4 gap-5">
    @forelse($vouchers as $v)
    <a href="{{ route('pelanggan.voucher.show', $v) }}" class="block relative bg-white border {{ $v->status === 'aktif' ? 'border-gray-200 hover:border-gray-400' : 'border-gray-100 opacity-60' }} rounded-xl overflow-hidden transition-all shadow-sm group">
        {{-- Header --}}
        <div class="px-4 py-3 border-b {{ $v->status === 'aktif' ? 'border-gray-100 bg-gray-50' : 'border-gray-50 bg-gray-50/50' }}">
            <div class="text-xs font-semibold text-gray-700 truncate">{{ $v->kategori?->nama_kategori }}</div>
        </div>

        {{-- Body: QR Code --}}
        <div class="p-5 flex flex-col items-center justify-center relative">
            <div class="w-24 h-24 relative">
                {!! file_get_contents(public_path('storage/' . $v->qr_code_path)) !!}

                {{-- Overlay Stempel Terpakai --}}
                @if($v->status === 'terpakai')
                <div class="absolute inset-0 flex items-center justify-center bg-white/70">
                    <div class="transform -rotate-12 border-2 border-red-500 text-red-500 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded">
                        Terpakai
                    </div>
                </div>
                @endif
            </div>
            <div class="mt-4 text-xs font-mono text-gray-500 tracking-wide">{{ $v->kode_voucher }}</div>
        </div>

        {{-- Footer --}}
        <div class="px-4 py-2 bg-gray-50 border-t border-gray-100 text-center">
            @if($v->status === 'aktif')
                <span class="text-[10px] font-medium text-green-600 uppercase tracking-wider">Siap Digunakan</span>
            @else
                <span class="text-[10px] font-medium text-gray-500 uppercase tracking-wider">Digunakan {{ $v->usages->last()?->tgl_digunakan?->format('d/m/Y') }}</span>
            @endif
        </div>
    </a>
    @empty
    <div class="col-span-4 text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
        <h3 class="text-sm font-medium text-gray-900">Belum ada voucher</h3>
        <p class="text-xs text-gray-500 mt-1">Anda belum memiliki voucher saat ini.</p>
    </div>
    @endforelse
</div>

@if($vouchers->hasPages())
<div class="mt-8">
    {{ $vouchers->links() }}
</div>
@endif
@endsection
