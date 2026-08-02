@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['label' => 'Total Pelanggan', 'value' => $totalPelanggan, 'badge' => '+3 bulan ini'],
        ['label' => 'Total Voucher', 'value' => $totalVoucher, 'badge' => '+20 bulan ini'],
        ['label' => 'Voucher Aktif', 'value' => $voucherAktif, 'badge' => '↑12%'],
        ['label' => 'Terpakai', 'value' => $voucherTerpakai, 'badge' => '↑8%'],
    ] as $stat)
    <div class="bg-[#FAF6ED] rounded-xl border border-[#E8DFC9] p-5">
        <div class="text-3xl font-bold text-[#2A2421]">{{ number_format($stat['value']) }}</div>
        <div class="text-sm text-[#635752] mt-0.5">{{ $stat['label'] }}</div>
        <div class="text-xs text-[#9E7B3B] mt-2">{{ $stat['badge'] }}</div>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
    {{-- Grafik 7 Hari --}}
    <div class="bg-[#FAF6ED] rounded-xl border border-[#E8DFC9] p-5">
        <h3 class="text-sm font-semibold text-[#2A2421] mb-4">Pemakaian 7 hari terakhir</h3>
        <div class="flex items-end gap-2 h-32">
            @php $maxCount = $pemakaian7Hari->max('count') ?: 1; @endphp
            @foreach($pemakaian7Hari as $day)
            <div class="flex-1 flex flex-col items-center gap-1">
                <div
                    class="w-full bg-[#2A2421] rounded-t-sm transition-all"
                    style="height: {{ max(4, ($day['count'] / $maxCount) * 100) }}%; min-height: 4px"
                    title="{{ $day['count'] }} pemakaian"
                ></div>
                <span class="text-[10px] text-[#9E7B3B]">{{ $day['label'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Aktivitas Terbaru --}}
    <div class="bg-[#FAF6ED] rounded-xl border border-[#E8DFC9] p-5">
        <h3 class="text-sm font-semibold text-[#2A2421] mb-4">Aktivitas terbaru</h3>
        <div class="space-y-3">
            @forelse($aktivitasTerbaru as $aktivitas)
            <div class="flex items-start gap-3">
                <div class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0 {{ $aktivitas->voucher?->status === 'terpakai' ? 'bg-[#C5A059]' : 'bg-[#E8DFC9]' }}"></div>
                <div>
                    <div class="text-sm text-[#2A2421]">
                        @if($aktivitas->voucher?->pelanggan)
                            {{ $aktivitas->voucher->pelanggan->name }} gunakan voucher {{ $aktivitas->voucher->kategori?->nama_kategori }}
                        @else
                            Aktivitas tidak diketahui
                        @endif
                    </div>
                    <div class="text-xs text-[#9E7B3B]">{{ $aktivitas->created_at->diffForHumans() }}</div>
                </div>
            </div>
            @empty
            <p class="text-sm text-[#635752]">Belum ada aktivitas.</p>
            @endforelse
        </div>
    </div>
</div>

{{-- Pelanggan Aktif --}}
<div class="bg-[#FAF6ED] rounded-xl border border-[#E8DFC9] p-5 overflow-hidden">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-semibold text-[#2A2421]">Pelanggan aktif</h3>
        <a href="{{ route('admin.pelanggan.index') }}" class="text-xs font-medium bg-[#2A2421] hover:bg-[#4A3E3D] text-[#F6EFDE] px-3 py-1.5 rounded-lg transition-colors">Lihat semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-xs text-[#9E7B3B] border-b border-[#E8DFC9]">
                    <th class="text-left pb-2 font-medium whitespace-nowrap">Nama</th>
                    <th class="text-left pb-2 font-medium whitespace-nowrap">Voucher Aktif</th>
                    <th class="text-left pb-2 font-medium whitespace-nowrap">Terpakai</th>
                    <th class="text-left pb-2 font-medium whitespace-nowrap">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E8DFC9]">
                @forelse($pelangganAktif as $p)
                <tr class="hover:bg-[#F6EFDE] transition-colors">
                    <td class="py-2.5 whitespace-nowrap">
                        <a href="{{ route('admin.pelanggan.show', $p) }}" class="font-medium text-[#2A2421] hover:underline">{{ $p->name }}</a>
                    </td>
                    <td class="py-2.5 text-[#635752]">{{ $p->voucher_aktif_count }}</td>
                    <td class="py-2.5 text-[#635752]">{{ $p->voucher_terpakai_count }}</td>
                    <td class="py-2.5">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium border border-[#C5A059]/50 text-[#9E7B3B] bg-[#C5A059]/10">Aktif</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="py-4 text-center text-[#635752] text-sm">Belum ada pelanggan aktif.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
