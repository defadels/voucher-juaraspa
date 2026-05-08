@extends('layouts.admin')
@section('title', 'Riwayat Pemakaian')
@section('page-title', 'Riwayat Pemakaian')

@section('content')
<form method="GET" class="bg-white rounded-xl border border-gray-200 p-4 mb-4 flex gap-3">
    <div class="flex-1">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode voucher atau nama pelanggan..."
            class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400">
    </div>
    <button type="submit" class="bg-gray-900 text-white text-sm px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors">Cari</button>
</form>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr class="text-xs text-gray-500 font-semibold uppercase tracking-wide">
                <th class="text-left px-5 py-3">Kode Voucher</th>
                <th class="text-left px-5 py-3">Pelanggan</th>
                <th class="text-left px-5 py-3">Kategori</th>
                <th class="text-left px-5 py-3">Tanggal Digunakan</th>
                <th class="text-left px-5 py-3">Keterangan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($riwayat as $r)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-3 font-mono text-xs font-medium">{{ $r->voucher?->kode_voucher }}</td>
                <td class="px-5 py-3 text-gray-700">{{ $r->voucher?->pelanggan?->name }}</td>
                <td class="px-5 py-3 text-gray-600">{{ $r->voucher?->kategori?->nama_kategori }}</td>
                <td class="px-5 py-3 text-gray-500">{{ $r->tgl_digunakan->format('d/m/Y') }}</td>
                <td class="px-5 py-3 text-gray-500">{{ $r->keterangan }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">Belum ada riwayat pemakaian.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($riwayat->hasPages())
    <div class="px-5 py-3 border-t border-gray-100">{{ $riwayat->links() }}</div>
    @endif
</div>
@endsection
