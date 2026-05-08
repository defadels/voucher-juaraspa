@extends('layouts.admin')
@section('title', 'Detail Pelanggan – ' . $pelanggan->name)
@section('page-title', 'Detail Pelanggan')

@section('content')
<div class="flex items-center gap-2 mb-5 text-sm text-gray-500">
    <a href="{{ route('admin.pelanggan.index') }}" class="hover:text-gray-900">Akun Pelanggan</a>
    <span>/</span>
    <span class="text-gray-900">{{ $pelanggan->name }}</span>
</div>

<div class="grid grid-cols-3 gap-4">
    {{-- Data Pelanggan --}}
    <div class="col-span-2 space-y-4">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Data Diri</h3>
            <dl class="grid grid-cols-2 gap-x-8 gap-y-3 text-sm">
                <div>
                    <dt class="text-xs text-gray-400 font-medium uppercase tracking-wide">Nama</dt>
                    <dd class="mt-0.5 text-gray-900 font-medium">{{ $pelanggan->name }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-400 font-medium uppercase tracking-wide">Email</dt>
                    <dd class="mt-0.5 text-gray-700">{{ $pelanggan->email }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-400 font-medium uppercase tracking-wide">No. Telepon</dt>
                    <dd class="mt-0.5 text-gray-700">{{ $pelanggan->nomor_telepon }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-gray-400 font-medium uppercase tracking-wide">Terdaftar</dt>
                    <dd class="mt-0.5 text-gray-700">{{ $pelanggan->created_at->format('d F Y') }}</dd>
                </div>
            </dl>
        </div>

        {{-- Riwayat Pemakaian --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-700">Riwayat Pemakaian Voucher</h3>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr class="text-xs text-gray-400 font-semibold uppercase tracking-wide">
                        <th class="text-left px-5 py-2">Kode Voucher</th>
                        <th class="text-left px-5 py-2">Kategori</th>
                        <th class="text-left px-5 py-2">Tanggal Digunakan</th>
                        <th class="text-left px-5 py-2">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($riwayatPemakaian as $usage)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-2.5 font-mono text-xs">{{ $usage->voucher->kode_voucher }}</td>
                        <td class="px-5 py-2.5 text-gray-700">{{ $usage->voucher->kategori?->nama_kategori }}</td>
                        <td class="px-5 py-2.5 text-gray-500">{{ $usage->tgl_digunakan->format('d/m/Y') }}</td>
                        <td class="px-5 py-2.5 text-gray-500">{{ $usage->keterangan }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-5 py-6 text-center text-gray-400">Belum ada pemakaian voucher.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-4">
        {{-- Statistik --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Statistik Voucher</h3>
            <div class="space-y-2">
                @php
                    $aktif = $pelanggan->voucherSebagaiPelanggan->where('status', 'aktif')->count();
                    $terpakai = $pelanggan->voucherSebagaiPelanggan->where('status', 'terpakai')->count();
                @endphp
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Voucher Aktif</span>
                    <span class="font-semibold text-gray-900">{{ $aktif }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Sudah Terpakai</span>
                    <span class="font-semibold text-gray-900">{{ $terpakai }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Total</span>
                    <span class="font-semibold text-gray-900">{{ $aktif + $terpakai }}</span>
                </div>
            </div>
        </div>

        {{-- Reset Password --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Reset Password</h3>

            @if($errors->any())
            <div class="mb-3 p-2 bg-red-50 border border-red-200 rounded text-xs text-red-700">
                {{ $errors->first() }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.pelanggan.reset-password', $pelanggan) }}" class="space-y-3">
                @csrf
                <input type="password" name="password" placeholder="Password baru" required
                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi password" required
                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
                <button type="submit" class="w-full bg-gray-900 text-white text-sm font-medium py-2 rounded-lg hover:bg-gray-800 transition-colors">
                    Reset Password
                </button>
            </form>
        </div>

        <a href="{{ route('admin.voucher.kirim') }}?pelanggan={{ $pelanggan->id }}"
           class="flex items-center justify-center w-full py-2.5 border border-gray-300 text-sm font-medium text-gray-700 rounded-xl hover:bg-gray-50 transition-colors">
            Kirim Voucher ke Pelanggan Ini
        </a>
    </div>
</div>
@endsection
