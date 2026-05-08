@extends('layouts.pelanggan')
@section('title', 'Beranda')
@section('page-title', 'Beranda')

@section('content')
    <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="col-span-2">
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
                    <div class="text-3xl font-bold text-gray-900">{{ $voucherAktif->count() }}</div>
                    <div class="text-sm font-medium text-gray-500 mt-1">Voucher Aktif</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
                    <div class="text-3xl font-bold text-gray-900">{{ $voucherTerpakai->count() }}</div>
                    <div class="text-sm font-medium text-gray-500 mt-1">Sudah Digunakan</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
                    <div class="text-3xl font-bold text-gray-900">{{ $voucherExpired->count() }}</div>
                    <div class="text-sm font-medium text-gray-500 mt-1">Expired</div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-base font-semibold text-gray-800">Voucher Aktif Saya</h2>
                    <a href="{{ route('pelanggan.voucher.index') }}"
                        class="text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition-colors">
                        Lihat semua
                    </a>
                </div>

                @if ($voucherAktif->isEmpty())
                    <div
                        class="text-center py-8 text-gray-500 text-sm bg-gray-50 rounded-lg border border-dashed border-gray-200">
                        Belum ada voucher aktif.
                    </div>
                @else
                    <div class="grid grid-cols-4 gap-4">
                        @foreach ($voucherAktif->take(4) as $v)
                            <a href="{{ route('pelanggan.voucher.show', $v) }}"
                                class="block p-4 border border-gray-200 rounded-xl hover:border-gray-400 transition-colors text-center group">
                                <div class="text-xs font-medium text-gray-500 mb-2 truncate">
                                    {{ $v->kategori?->nama_kategori }}</div>
                                <div class="w-16 h-16 mx-auto mb-3 opacity-80 group-hover:opacity-100 transition-opacity">
                                    @if (Storage::disk('public')->exists($v->qr_code_path))
                                        <img src="{{ asset('storage/' . $v->qr_code_path) }}" alt="QR Code"
                                            class="w-full h-full object-contain">
                                    @else
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                                            <i class="fas fa-qrcode text-2xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-[10px] font-mono text-gray-400">{{ $v->kode_voucher }}</div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="col-span-1">
            <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm h-full">
                <h2 class="text-base font-semibold text-gray-800 mb-5">Notifikasi</h2>

                <div class="space-y-4">
                    @forelse($notifikasi as $notif)
                        <div
                            class="flex items-start gap-3 relative pb-4 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                            <div
                                class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0 {{ $notif['aktif'] ? 'bg-blue-500' : 'bg-gray-300' }}">
                            </div>
                            <div>
                                <p class="text-sm text-gray-800 leading-relaxed">{{ $notif['pesan'] }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notif['waktu'] }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">Belum ada notifikasi.</p>
                    @endforelse

                    @if ($voucherTerpakai->isNotEmpty())
                        @php $lastTerpakai = $voucherTerpakai->sortByDesc('updated_at')->first(); @endphp
                        <div class="flex items-start gap-3 relative pb-4">
                            <div class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0 bg-gray-300"></div>
                            <div>
                                <p class="text-sm text-gray-800 leading-relaxed">Voucher {{ $lastTerpakai->kode_voucher }}
                                    berhasil digunakan</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $lastTerpakai->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
