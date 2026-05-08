@extends('layouts.admin')
@section('title', 'Akun Pelanggan')
@section('page-title', 'Akun Pelanggan')

@section('content')
<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">Total {{ $pelangganList->total() }} pelanggan terdaftar</p>
    <a href="{{ route('admin.pelanggan.create') }}" class="bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors">
        + Buat Akun
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr class="text-xs text-gray-500 font-semibold uppercase tracking-wide">
                <th class="text-left px-5 py-3">Nama</th>
                <th class="text-left px-5 py-3">Email</th>
                <th class="text-left px-5 py-3">No. Telepon</th>
                <th class="text-left px-5 py-3">Voucher Aktif</th>
                <th class="text-left px-5 py-3">Terpakai</th>
                <th class="text-left px-5 py-3">Terdaftar</th>
                <th class="px-5 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($pelangganList as $pelanggan)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-3 font-medium text-gray-900">{{ $pelanggan->name }}</td>
                <td class="px-5 py-3 text-gray-500">{{ $pelanggan->email }}</td>
                <td class="px-5 py-3 text-gray-500">{{ $pelanggan->nomor_telepon }}</td>
                <td class="px-5 py-3 text-gray-700">{{ $pelanggan->voucher_aktif }}</td>
                <td class="px-5 py-3 text-gray-700">{{ $pelanggan->voucher_terpakai }}</td>
                <td class="px-5 py-3 text-gray-400 text-xs">{{ $pelanggan->created_at->format('d/m/Y') }}</td>
                <td class="px-5 py-3">
                    <a href="{{ route('admin.pelanggan.show', $pelanggan) }}" class="text-xs text-gray-600 hover:text-gray-900 underline">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-5 py-8 text-center text-gray-400">Belum ada akun pelanggan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($pelangganList->hasPages())
    <div class="px-5 py-3 border-t border-gray-100">
        {{ $pelangganList->links() }}
    </div>
    @endif
</div>
@endsection
