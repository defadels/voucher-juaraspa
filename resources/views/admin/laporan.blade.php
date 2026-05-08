@extends('layouts.admin')
@section('title', 'Laporan')
@section('page-title', 'Laporan Pemakaian Voucher')

@section('content')
{{-- Filter Laporan --}}
<form method="GET" class="bg-white rounded-xl border border-gray-200 p-5 mb-6">
    <div class="flex items-end gap-4">
        <div class="w-48">
            <label class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wider">Bulan</label>
            <select name="bulan" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400">
                @foreach($bulanOptions as $opt)
                    <option value="{{ $opt['value'] }}" {{ $bulan == $opt['value'] ? 'selected' : '' }}>
                        {{ $opt['label'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="w-32">
            <label class="block text-xs font-medium text-gray-500 mb-1.5 uppercase tracking-wider">Tahun</label>
            <select name="tahun" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400">
                @foreach($tahunOptions as $opt)
                    <option value="{{ $opt }}" {{ $tahun == $opt ? 'selected' : '' }}>
                        {{ $opt }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-gray-900 text-white text-sm font-medium px-5 py-2.5 rounded-lg hover:bg-gray-800 transition-colors">
            Tampilkan Laporan
        </button>
        <button type="button" onclick="window.print()" class="bg-white border border-gray-200 text-gray-700 text-sm font-medium px-5 py-2.5 rounded-lg hover:bg-gray-50 transition-colors flex items-center gap-2 ml-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak PDF
        </button>
    </div>
</form>

<div class="grid grid-cols-2 gap-6 mb-6">
    {{-- Ringkasan Global --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="text-sm font-semibold text-gray-800 mb-5 border-b border-gray-100 pb-3">Ringkasan Global Sistem</h3>
        <div class="grid grid-cols-2 gap-y-6 gap-x-4">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Total Pelanggan</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($totalPelanggan) }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Total Diterbitkan</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($totalVoucher) }}</p>
            </div>
            <div>
                <p class="text-xs text-green-600 uppercase tracking-wide font-medium mb-1">Total Aktif</p>
                <p class="text-2xl font-bold text-green-700">{{ number_format($voucherAktif) }}</p>
            </div>
            <div>
                <p class="text-xs text-blue-600 uppercase tracking-wide font-medium mb-1">Total Terpakai</p>
                <p class="text-2xl font-bold text-blue-700">{{ number_format($voucherTerpakai) }}</p>
            </div>
        </div>
    </div>

    {{-- Grafik Sederhana Pemakaian Bulan Ini --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="text-sm font-semibold text-gray-800 mb-5 border-b border-gray-100 pb-3">Tren Pemakaian Bulan Ini</h3>
        @if($pemakaianBulanIni->isEmpty())
            <div class="flex items-center justify-center h-32 text-sm text-gray-400 bg-gray-50 rounded-lg">
                Tidak ada data pemakaian di bulan ini.
            </div>
        @else
            <div class="flex items-end gap-1 h-32">
                @php $maxUsage = $pemakaianBulanIni->max('jumlah') ?: 1; @endphp
                @for($i = 1; $i <= \Carbon\Carbon::createFromDate($tahun, $bulan)->daysInMonth; $i++)
                    @php $usage = $pemakaianBulanIni->get($i); @endphp
                    <div class="flex-1 flex flex-col justify-end group relative">
                        @if($usage)
                            <div class="bg-gray-900 rounded-t-sm w-full transition-all group-hover:bg-blue-600"
                                 style="height: {{ max(5, ($usage->jumlah / $maxUsage) * 100) }}%"></div>
                            {{-- Tooltip sederhana --}}
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-1 hidden group-hover:block bg-gray-900 text-white text-[10px] py-0.5 px-1.5 rounded whitespace-nowrap z-10">
                                Tgl {{ $i }}: {{ $usage->jumlah }}
                            </div>
                        @else
                            <div class="bg-gray-100 rounded-t-sm w-full" style="height: 2px"></div>
                        @endif
                    </div>
                @endfor
            </div>
            <div class="flex justify-between text-[10px] text-gray-400 mt-2">
                <span>Tgl 1</span>
                <span>Tgl {{ \Carbon\Carbon::createFromDate($tahun, $bulan)->daysInMonth }}</span>
            </div>
        @endif
    </div>
</div>

{{-- Rekap per Kategori --}}
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-gray-800">Distribusi Kategori Voucher</h3>
        <span class="text-xs text-gray-500">Status saat ini</span>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-white border-b border-gray-100">
            <tr class="text-xs text-gray-500 font-medium uppercase tracking-wide">
                <th class="text-left px-6 py-3">Nama Kategori</th>
                <th class="text-right px-6 py-3 text-blue-600">Total Diterbitkan</th>
                <th class="text-right px-6 py-3 text-green-600">Terpakai</th>
                <th class="text-right px-6 py-3">Belum Dipakai (Aktif)</th>
                <th class="text-right px-6 py-3">Tingkat Pemakaian</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($rekapKategori as $kat)
                @php
                    $belumDipakai = $kat->total_diterbitkan - $kat->total_terpakai;
                    $persentase = $kat->total_diterbitkan > 0
                        ? round(($kat->total_terpakai / $kat->total_diterbitkan) * 100)
                        : 0;
                @endphp
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $kat->nama_kategori }}</td>
                    <td class="px-6 py-4 text-right font-medium">{{ number_format($kat->total_diterbitkan) }}</td>
                    <td class="px-6 py-4 text-right text-gray-600">{{ number_format($kat->total_terpakai) }}</td>
                    <td class="px-6 py-4 text-right text-gray-600">{{ number_format($belumDipakai) }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <span class="text-xs text-gray-500 w-8 text-right">{{ $persentase }}%</span>
                            <div class="w-16 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-gray-800" style="width: {{ $persentase }}%"></div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada kategori voucher.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot class="bg-gray-50 font-medium">
            <tr>
                <td class="px-6 py-3">Total Seluruh Kategori</td>
                <td class="px-6 py-3 text-right">{{ number_format($rekapKategori->sum('total_diterbitkan')) }}</td>
                <td class="px-6 py-3 text-right">{{ number_format($rekapKategori->sum('total_terpakai')) }}</td>
                <td class="px-6 py-3 text-right">{{ number_format($rekapKategori->sum('total_diterbitkan') - $rekapKategori->sum('total_terpakai')) }}</td>
                <td class="px-6 py-3"></td>
            </tr>
        </tfoot>
    </table>
</div>

<style>
@media print {
    aside, header, form button:not([type="button"]) { display: none !important; }
    main { padding: 0 !important; }
    .bg-white { border: none !important; box-shadow: none !important; }
}
</style>
@endsection
