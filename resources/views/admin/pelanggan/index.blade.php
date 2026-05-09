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
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr class="text-xs text-gray-500 font-semibold uppercase tracking-wide">
                    <th class="text-left px-5 py-3 whitespace-nowrap">Nama</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">Email</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">No. Telepon</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">Voucher Aktif</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">Terpakai</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">Terdaftar</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pelangganList as $pelanggan)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $pelanggan->name }}</td>
                    <td class="px-5 py-3 text-gray-500 whitespace-nowrap">{{ $pelanggan->email }}</td>
                    <td class="px-5 py-3 text-gray-500 whitespace-nowrap">{{ $pelanggan->nomor_telepon }}</td>
                    <td class="px-5 py-3 text-gray-700">{{ $pelanggan->voucher_aktif }}</td>
                    <td class="px-5 py-3 text-gray-700">{{ $pelanggan->voucher_terpakai }}</td>
                    <td class="px-5 py-3 text-gray-400 text-xs whitespace-nowrap">{{ $pelanggan->created_at->format('d/m/Y') }}</td>
                    <td class="px-5 py-3 whitespace-nowrap">
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
    </div>

    @if($pelangganList->hasPages())
    <div class="px-5 py-3 border-t border-gray-100">
        {{ $pelangganList->links() }}
    </div>
    @endif
</div>
@endsection
