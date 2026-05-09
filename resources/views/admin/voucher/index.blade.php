@extends('layouts.admin')
@section('title', 'Semua Voucher')
@section('page-title', 'Semua Voucher')

@section('content')
{{-- Filter --}}
<form method="GET" class="bg-white rounded-xl border border-gray-200 p-4 mb-4 grid grid-cols-1 md:grid-cols-2 lg:flex gap-3 items-end">
    <div class="lg:flex-1">
        <label class="block text-xs text-gray-500 mb-1">Cari</label>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Kode voucher atau nama pelanggan..."
            class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
    </div>
    <div>
        <label class="block text-xs text-gray-500 mb-1">Status</label>
        <select name="status" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none">
            <option value="">Semua</option>
            <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="terpakai" {{ request('status') === 'terpakai' ? 'selected' : '' }}>Terpakai</option>
        </select>
    </div>
    <div>
        <label class="block text-xs text-gray-500 mb-1">Kategori</label>
        <select name="kategori_id" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none">
            <option value="">Semua Kategori</option>
            @foreach($kategoris as $k)
            <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex gap-2">
        <button type="submit" class="flex-1 bg-gray-900 text-white text-sm px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors">Filter</button>
        <a href="{{ route('admin.voucher.index') }}" class="flex-1 text-center border border-gray-200 text-sm px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors">Reset</a>
    </div>
</form>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr class="text-xs text-gray-500 font-semibold uppercase tracking-wide">
                    <th class="text-left px-5 py-3 whitespace-nowrap">Kode Voucher</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">Pelanggan</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">Kategori</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">Tgl Terbit</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($vouchers as $v)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 font-mono text-xs font-medium text-gray-900 whitespace-nowrap">{{ $v->kode_voucher }}</td>
                    <td class="px-5 py-3 whitespace-nowrap">
                        <a href="{{ route('admin.pelanggan.show', $v->pelanggan) }}" class="text-gray-700 hover:underline">{{ $v->pelanggan?->name }}</a>
                    </td>
                    <td class="px-5 py-3 text-gray-600 whitespace-nowrap">{{ $v->kategori?->nama_kategori }}</td>
                    <td class="px-5 py-3 text-gray-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($v->tgl_terbit)->format('d/m/Y') }}</td>
                    <td class="px-5 py-3 whitespace-nowrap">
                        @if($v->status === 'aktif')
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border border-green-300 text-green-700">Aktif</span>
                        @else
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">Terpakai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-gray-400">Tidak ada voucher ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($vouchers->hasPages())
    <div class="px-5 py-3 border-t border-gray-100">{{ $vouchers->links() }}</div>
    @endif
</div>
@endsection
