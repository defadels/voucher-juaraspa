@extends('layouts.pelanggan')
@section('title', 'Beranda')
@section('page-title', 'Beranda')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-[#FAF6ED] rounded-xl border border-[#E8DFC9] p-5 shadow-sm">
                    <div class="text-3xl font-bold text-[#2A2421]">{{ $voucherAktif->count() }}</div>
                    <div class="text-sm font-medium text-[#635752] mt-1">Voucher Aktif</div>
                </div>
                <div class="bg-[#FAF6ED] rounded-xl border border-[#E8DFC9] p-5 shadow-sm">
                    <div class="text-3xl font-bold text-[#2A2421]">{{ $voucherTerpakai->count() }}</div>
                    <div class="text-sm font-medium text-[#635752] mt-1">Sudah Digunakan</div>
                </div>
                {{-- <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
                    <div class="text-3xl font-bold text-gray-900">{{ $voucherExpired->count() }}</div>
                    <div class="text-sm font-medium text-gray-500 mt-1">Expired</div>
                </div> --}}
            </div>

            <div class="bg-[#FAF6ED] rounded-xl border border-[#E8DFC9] p-6 shadow-sm">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-base font-semibold text-[#2A2421]">Voucher Aktif Saya</h2>
                    <a href="{{ route('pelanggan.voucher.index') }}"
                        class="text-sm font-medium text-[#F6EFDE] bg-[#2A2421] hover:bg-[#4A3E3D] px-4 py-2 rounded-lg transition-colors">
                        Lihat semua
                    </a>
                </div>

                @if ($voucherAktif->isEmpty())
                    <div
                        class="text-center py-8 text-[#635752] text-sm bg-[#F6EFDE] rounded-lg border border-dashed border-[#E8DFC9]">
                        Belum ada voucher aktif.
                    </div>
                @else
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($voucherAktif->take(4) as $v)
                            <a href="{{ route('pelanggan.voucher.show', $v) }}"
                                class="block p-4 border border-[#E8DFC9] rounded-xl hover:border-[#C5A059] transition-colors text-center group">
                                <div class="text-xs font-medium text-[#9E7B3B] mb-2 truncate">
                                    {{ $v->kategori?->nama_kategori }}</div>
                                <div class="w-16 h-16 mx-auto mb-3 opacity-80 group-hover:opacity-100 transition-opacity">
                                    @if (Storage::disk('public')->exists($v->qr_code_path))
                                        <img src="{{ asset('storage/' . $v->qr_code_path) }}" alt="QR Code"
                                            class="w-full h-full object-contain">
                                    @else
                                        <div
                                            class="w-16 h-16 bg-[#E8DFC9] rounded flex items-center justify-center text-[#9E7B3B]">
                                            <i class="fas fa-qrcode text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-[10px] font-mono text-[#9E7B3B]">{{ $v->kode_voucher }}</div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-[#FAF6ED] rounded-xl border border-[#E8DFC9] p-5 shadow-sm h-full">
                <h2 class="text-base font-semibold text-[#2A2421] mb-5">Notifikasi</h2>

                <div class="space-y-4">
                    @forelse($notifikasi as $notif)
                        <div
                            class="flex items-start gap-3 relative pb-4 {{ !$loop->last ? 'border-b border-[#E8DFC9]' : '' }}">
                            <div
                                class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0 {{ $notif['aktif'] ? 'bg-[#C5A059]' : 'bg-[#E8DFC9]' }}">
                            </div>
                            <div>
                                <p class="text-sm text-[#2A2421] leading-relaxed">{{ $notif['pesan'] }}</p>
                                <p class="text-xs text-[#9E7B3B] mt-1">{{ $notif['waktu'] }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-[#635752] text-center py-4">Belum ada notifikasi.</p>
                    @endforelse

                    @if ($voucherTerpakai->isNotEmpty())
                        @php $lastTerpakai = $voucherTerpakai->sortByDesc('updated_at')->first(); @endphp
                        <div class="flex items-start gap-3 relative pb-4">
                            <div class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0 bg-[#E8DFC9]"></div>
                            <div>
                                <p class="text-sm text-[#2A2421] leading-relaxed">Voucher {{ $lastTerpakai->kode_voucher }}
                                    berhasil digunakan</p>
                                <p class="text-xs text-[#9E7B3B] mt-1">{{ $lastTerpakai->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
