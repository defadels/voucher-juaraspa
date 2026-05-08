@extends('layouts.pelanggan')
@section('title', 'Riwayat Pemakaian')
@section('page-title', 'Riwayat Pemakaian Voucher')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
        <h2 class="text-sm font-semibold text-gray-800">Riwayat Penggunaan</h2>
        <p class="text-xs text-gray-500 mt-1">Daftar semua voucher yang telah Anda gunakan di Juara SPA</p>
    </div>

    <table class="w-full text-sm text-left">
        <thead class="bg-white border-b border-gray-100">
            <tr class="text-xs text-gray-500 font-medium uppercase tracking-wide">
                <th class="px-6 py-3">Tanggal Digunakan</th>
                <th class="px-6 py-3">Kode Voucher</th>
                <th class="px-6 py-3">Kategori Perawatan</th>
                <th class="px-6 py-3">Keterangan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($riwayat as $r)
            <tr class="hover:bg-gray-50 transition-colors group">
                <td class="px-6 py-4 text-gray-600 font-medium whitespace-nowrap">
                    {{ $r->tgl_digunakan->format('d M Y') }}
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('pelanggan.voucher.show', $r->voucher_id) }}" class="font-mono text-gray-900 font-medium hover:underline group-hover:text-blue-600 transition-colors">
                        {{ $r->voucher?->kode_voucher }}
                    </a>
                </td>
                <td class="px-6 py-4 text-gray-700">
                    {{ $r->voucher?->kategori?->nama_kategori }}
                </td>
                <td class="px-6 py-4 text-gray-500">
                    {{ $r->keterangan }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-12 text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-50 mb-3">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-sm font-medium text-gray-900">Belum ada riwayat</p>
                    <p class="text-xs text-gray-500 mt-1">Anda belum pernah menggunakan voucher.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($riwayat->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-white">
        {{ $riwayat->links() }}
    </div>
    @endif
</div>
@endsection
