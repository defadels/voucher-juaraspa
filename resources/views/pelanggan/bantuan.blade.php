@extends('layouts.pelanggan')
@section('title', 'Bantuan')
@section('page-title', 'Pusat Bantuan')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-10 mt-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Ada yang bisa kami bantu?</h2>
            <p class="text-sm text-gray-500">Temukan jawaban untuk pertanyaan umum seputar voucher Juara SPA.</p>
        </div>

        <div class="space-y-4 mb-10">
            {{-- FAQ Items --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-base font-semibold text-gray-800 mb-2">Bagaimana cara menggunakan voucher saya?</h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Buka menu <a href="{{ route('pelanggan.voucher.index') }}"
                        class="text-blue-600 hover:underline font-medium">Voucher Saya</a>, pilih voucher yang ingin
                    digunakan. Tunjukkan halaman yang menampilkan QR Code dan Kode Voucher kepada kasir atau resepsionis di
                    Juara SPA saat Anda ingin melakukan pembayaran.
                </p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-base font-semibold text-gray-800 mb-2">Berapa lama masa berlaku voucher?</h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Saat ini voucher Juara SPA tidak memiliki batas kedaluwarsa kecuali diinformasikan sebaliknya secara
                    spesifik oleh admin saat menerbitkan voucher. Anda dapat menggunakannya kapan saja.
                </p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-base font-semibold text-gray-800 mb-2">Apakah voucher bisa dipindahtangankan?</h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Voucher terikat pada akun Anda untuk tujuan keamanan. Namun Anda dapat menggunakan voucher tersebut
                    untuk membayarkan perawatan orang lain selama Anda yang menunjukkan QR Code dari akun Anda secara
                    langsung di lokasi.
                </p>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h3 class="text-base font-semibold text-gray-800 mb-2">Saya lupa password, apa yang harus dilakukan?</h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Untuk alasan keamanan, perubahan password atau email yang lupa hanya dapat dilakukan oleh Admin sistem.
                    Silakan hubungi Customer Service Juara SPA melalui WhatsApp.
                </p>
            </div>
        </div>

        {{-- Kontak CS --}}
        <div class="bg-gray-900 rounded-2xl p-8 text-center text-white relative overflow-hidden">
            <div
                class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMSI+PC9yZWN0Pgo8cGF0aCBkPSJNMCAwTDggOFpNOCAwTDAgOFoiIHN0cm9rZT0iI2ZmZiIgc3Ryb2tlLW9wYWNpdHk9IjAuNCIgc3Ryb2tlLXdpZHRoPSIxIj48L3BhdGg+Cjwvc3ZnPg==')]">
            </div>
            <div class="relative z-10">
                <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Butuh bantuan lebih lanjut?</h3>
                <p class="text-white/70 text-sm mb-6">Tim Juara SPA siap membantu keluhan Anda terkait voucher</p>
                <a href="https://wa.me/6285366206336" target="_blank"
                    class="inline-flex items-center gap-2 bg-white text-gray-900 font-medium px-6 py-3 rounded-lg hover:bg-gray-100 transition-colors">
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>
@endsection
