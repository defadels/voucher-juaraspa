@extends('layouts.admin')
@section('title', 'Kategori Voucher')
@section('page-title', 'Manajemen Kategori Voucher')

@section('content')
<div class="flex items-center justify-between mb-5">
    <p class="text-sm text-gray-500">Terdapat {{ $kategoris->count() }} kategori voucher</p>
    <a href="{{ route('admin.kategori-voucher.create') }}" class="bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors">
        + Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr class="text-xs text-gray-500 font-semibold uppercase tracking-wide">
                    <th class="text-left px-5 py-3 whitespace-nowrap">Nama Kategori</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">Prefix Kode</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">Deskripsi</th>
                    <th class="text-left px-5 py-3 whitespace-nowrap">Total Voucher</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($kategoris as $kategori)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $kategori->nama_kategori }}</td>
                    <td class="px-5 py-3 whitespace-nowrap">
                        <span class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded font-mono text-xs border border-gray-200">
                            {{ $kategori->prefix }}
                        </span>
                    </td>
                    <td class="px-5 py-3 text-gray-500 min-w-[200px]">{{ Str::limit($kategori->deskripsi, 50) ?: '-' }}</td>
                    <td class="px-5 py-3 text-gray-700">{{ $kategori->vouchers_count ?? $kategori->vouchers()->count() }}</td>
                    <td class="px-5 py-3 text-right space-x-2 whitespace-nowrap">
                        <a href="{{ route('admin.kategori-voucher.edit', $kategori) }}" class="text-xs text-blue-600 hover:text-blue-900 underline">Edit</a>
                        <form action="{{ route('admin.kategori-voucher.destroy', $kategori) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-600 hover:text-red-900 underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-8 text-center text-gray-400">Belum ada kategori voucher.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
