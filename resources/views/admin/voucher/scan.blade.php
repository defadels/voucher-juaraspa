@extends('layouts.admin')
@section('title', 'Scan Voucher')
@section('page-title', 'Scan & Validasi Voucher')

@section('content')
    <div x-data="scanVoucher()" x-init="initScanner()">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            {{-- Left Panel: Scanner --}}
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm flex flex-col">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-sm font-semibold text-gray-800">Scan QR Code Pelanggan</h2>
                </div>

                <div class="p-6 flex-1 flex flex-col">
                    {{-- Camera UI --}}
                    <div class="relative mb-6 mx-auto w-full max-w-sm">
                        <div id="reader"
                            class="rounded-xl overflow-hidden border-2 border-dashed border-gray-300 min-h-[250px] bg-gray-50 flex items-center justify-center relative">
                            <div id="reader-placeholder"
                                class="text-center absolute inset-0 flex flex-col items-center justify-center z-10 pointer-events-none"
                                x-show="!scannerActive">
                                <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-xs text-gray-500">Memuat kamera...</p>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <p class="text-sm text-gray-600">Arahkan kamera ke QR Code<br>yang ditampilkan pelanggan</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 my-2">
                        <div class="flex-1 border-t border-gray-200"></div>
                        <span class="text-xs text-gray-400 uppercase tracking-widest">atau kode manual</span>
                        <div class="flex-1 border-t border-gray-200"></div>
                    </div>

                    {{-- Manual Input --}}
                    <div class="flex gap-2 mt-4">
                        <input x-model="kode" x-on:keydown.enter="validasi()" type="text" id="kode-voucher-input"
                            placeholder="Ketik kode voucher..."
                            class="flex-1 px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm font-mono focus:outline-none focus:border-gray-400 transition-colors uppercase">
                        <button x-on:click="validasi()" :disabled="loading"
                            class="bg-white border border-gray-300 text-gray-800 text-sm font-semibold px-6 py-3 rounded-lg hover:bg-gray-50 disabled:opacity-50 transition-all shadow-sm">
                            <span x-show="!loading">Cek</span>
                            <span x-show="loading">...</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Right Panel: Hasil Validasi --}}
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm flex flex-col">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-sm font-semibold text-gray-800">Hasil Validasi</h2>
                </div>

                <div class="p-6 flex-1 flex flex-col items-center justify-center relative">

                    {{-- Empty State --}}
                    <div x-show="state === null" class="text-center">
                        <div class="inline-flex flex-wrap w-16 h-16 opacity-30 mx-auto mb-4 gap-1 justify-center">
                            <div class="w-7 h-7 border-4 border-gray-400 rounded-sm"></div>
                            <div class="w-7 h-7 border-4 border-gray-400 rounded-sm"></div>
                            <div class="w-7 h-7 border-4 border-gray-400 rounded-sm"></div>
                            <div class="w-3 h-3 bg-gray-400 rounded-sm mt-1 ml-1"></div>
                        </div>
                        <h3 class="text-sm font-medium text-gray-800">Belum ada voucher discan</h3>
                        <p class="text-xs text-gray-500 mt-1">Scan QR Code atau masukkan kode voucher</p>
                    </div>

                    {{-- The Validation States --}}
                    <div class="w-full" x-show="state !== null" x-cloak>
                        {{-- STATE: VALID ✅ --}}
                        <div x-show="state === 'valid'" class="text-left w-full h-full flex flex-col">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900 text-lg">Voucher Valid</div>
                                    <div class="text-sm text-gray-500" x-text="pesan"></div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 mb-6 space-y-3 flex-1">
                                <div class="flex justify-between"><span
                                        class="text-xs font-semibold text-gray-500 uppercase">Kode</span><span
                                        class="font-mono font-bold text-gray-900" x-text="voucher?.kode"></span></div>
                                <div class="flex justify-between"><span
                                        class="text-xs font-semibold text-gray-500 uppercase">Pelanggan</span><span
                                        class="font-medium text-gray-900" x-text="voucher?.pelanggan"></span></div>
                                <div class="flex justify-between"><span
                                        class="text-xs font-semibold text-gray-500 uppercase">Kategori</span><span
                                        class="font-medium text-gray-900" x-text="voucher?.kategori"></span></div>
                            </div>

                            <div class="mb-4 mt-auto">
                                <input x-model="keterangan" type="text" placeholder="Catatan opsional..."
                                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
                            </div>

                            <button x-on:click="gunakan()" :disabled="loadingGunakan"
                                class="w-full bg-green-600 text-white text-sm font-semibold py-3.5 rounded-xl hover:bg-green-700 disabled:opacity-50 transition-colors shadow-sm flex items-center justify-center gap-2">
                                <span x-show="!loadingGunakan">Gunakan Voucher Ini</span>
                                <span x-show="loadingGunakan">Memproses...</span>
                            </button>
                        </div>

                        {{-- STATE: BERHASIL ✅✅ --}}
                        <div x-show="state === 'berhasil'" class="text-center w-full">
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
                                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl mb-2">Berhasil Digunakan!</h3>
                            <p class="text-sm text-gray-500 mb-8" x-text="pesan"></p>
                            <button x-on:click="reset()"
                                class="w-full bg-gray-900 text-white text-sm font-medium py-3.5 rounded-xl hover:bg-gray-800 transition-colors">
                                Scan Voucher Berikutnya
                            </button>
                        </div>

                        {{-- STATE: SUDAH TERPAKAI ⚠️ --}}
                        <div x-show="state === 'sudah_terpakai'" class="text-center w-full">
                            <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-5">
                                <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl mb-2">Sudah Terpakai</h3>
                            <p class="text-sm text-gray-500 mb-6" x-text="pesan"></p>

                            <div class="bg-amber-50 rounded-xl p-4 border border-amber-100 mb-6 text-left space-y-2">
                                <div class="flex justify-between"><span
                                        class="text-xs font-semibold text-amber-700 uppercase">Kode</span><span
                                        class="font-mono font-medium text-amber-900" x-text="voucher?.kode"></span></div>
                                <div class="flex justify-between"><span
                                        class="text-xs font-semibold text-amber-700 uppercase">Pelanggan</span><span
                                        class="font-medium text-amber-900" x-text="voucher?.pelanggan"></span></div>
                                <div class="flex justify-between"><span
                                        class="text-xs font-semibold text-amber-700 uppercase">Tgl Pakai</span><span
                                        class="font-medium text-amber-900" x-text="voucher?.tgl_digunakan"></span></div>
                            </div>

                            <button x-on:click="reset()"
                                class="w-full border-2 border-gray-200 text-gray-800 text-sm font-semibold py-3 rounded-xl hover:bg-gray-50 transition-colors">
                                Coba Voucher Lain
                            </button>
                        </div>

                        {{-- STATE: TIDAK DITEMUKAN ❌ --}}
                        <div x-show="state === 'tidak_ditemukan' || state === 'error'" class="text-center w-full">
                            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-5">
                                <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-900 text-xl mb-2">Voucher Tidak Ditemukan</h3>
                            <p class="text-sm text-gray-500 mb-8" x-text="pesan"></p>
                            <button x-on:click="reset()"
                                class="w-full border-2 border-gray-200 text-gray-800 text-sm font-semibold py-3 rounded-xl hover:bg-gray-50 transition-colors">
                                Coba Lagi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Table: Log Scan Hari Ini --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h2 class="text-sm font-semibold text-gray-800">Log Scan Hari Ini</h2>
                <span class="text-xs text-gray-500">{{ $logHariIni->count() }} voucher digunakan</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-white border-b border-gray-100">
                        <tr class="text-[11px] text-gray-500 font-bold uppercase tracking-wider">
                            <th class="px-6 py-3">Waktu</th>
                            <th class="px-6 py-3">Kode</th>
                            <th class="px-6 py-3">Pelanggan</th>
                            <th class="px-6 py-3">Layanan</th>
                            <th class="px-6 py-3">Hasil</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($logHariIni as $log)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 text-gray-600 font-medium whitespace-nowrap">
                                    {{ $log->created_at->format('H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="font-mono text-gray-900 font-medium">{{ $log->voucher?->kode_voucher }}</span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $log->voucher?->pelanggan?->name }}
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $log->voucher?->kategori?->nama_kategori }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-green-100 text-green-700">
                                        Berhasil
                                    </span>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">
                                    Belum ada voucher yang di-scan hari ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4 border-t bg-white border-gray-100">
                    {{ $logHariIni->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function scanVoucher() {
            return {
                kode: '',
                keterangan: 'Digunakan di Juara SPA',
                state: null,
                pesan: '',
                voucher: null,
                loading: false,
                loadingGunakan: false,
                scannerActive: false,
                html5QrcodeScanner: null,

                initScanner() {
                    // html5-qrcode renderer
                    const html5QrCode = new Html5Qrcode("reader");

                    // Konfigurasi scanner
                    const config = {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    };

                    // Start scanning from rear camera
                    html5QrCode.start({
                        facingMode: "environment"
                    }, config, (decodedText) => {
                        // Ketika QR terbaca, dan kita sedang belum menampilkan hasil apa-apa
                        if (this.state === null) {
                            this.kode = decodedText;
                            this.validasi();
                        }
                    }, (errorMessage) => {
                        // Ignore parse errors (terjadi terus-menerus selama kamera on tapi tidak ada QR)
                    }).then(() => {
                        this.scannerActive = true;
                    }).catch((err) => {
                        console.error("Gagal mengakses kamera:", err);
                    });

                    this.html5QrcodeScanner = html5QrCode;
                },

                async validasi() {
                    if (!this.kode.trim()) return;
                    this.loading = true;
                    this.state = null;

                    try {
                        const res = await fetch('{{ route('admin.scan.validasi') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: JSON.stringify({
                                kode_voucher: this.kode.trim().toUpperCase()
                            }),
                        });

                        const data = await res.json();
                        this.state = data.state;
                        this.pesan = data.pesan;
                        this.voucher = data.voucher || null;
                    } catch (e) {
                        this.state = 'error';
                        this.pesan = 'Terjadi kesalahan jaringan. Coba lagi.';
                    } finally {
                        this.loading = false;
                    }
                },

                async gunakan() {
                    if (!this.voucher?.id) return;
                    this.loadingGunakan = true;

                    try {
                        const res = await fetch('{{ route('admin.scan.gunakan') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            },
                            body: JSON.stringify({
                                voucher_id: this.voucher.id,
                                keterangan: this.keterangan
                            }),
                        });

                        const data = await res.json();
                        this.state = data.state;
                        this.pesan = data.pesan;

                        // Refresh halaman untuk mengupdate tabel history setelah 1.5 detik
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);

                    } catch (e) {
                        this.state = 'error';
                        this.pesan = 'Gagal memproses. Coba lagi.';
                    } finally {
                        this.loadingGunakan = false;
                    }
                },

                reset() {
                    this.kode = '';
                    this.state = null;
                    this.pesan = '';
                    this.voucher = null;

                    setTimeout(() => {
                        document.getElementById('kode-voucher-input')?.focus();
                    }, 100);
                },
            };
        }
    </script>

    <style>
        /* Clean up html5-qrcode UI */
        #reader button {
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 12px;
            margin: 5px;
            cursor: pointer;
        }

        #reader select {
            padding: 6px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            font-size: 12px;
            margin: 5px;
        }

        #reader video {
            object-fit: cover !important;
            width: 100% !important;
        }
    </style>
@endsection
