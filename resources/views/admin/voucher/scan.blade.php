@extends('layouts.admin')
@section('title', 'Scan Voucher')
@section('page-title', 'Scan Voucher')

@section('content')
<div class="max-w-lg mx-auto" x-data="scanVoucher()">
    {{-- Input Kode --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-4">
        <h2 class="text-sm font-semibold text-gray-700 mb-3">Masukkan / Scan Kode Voucher</h2>

        <div class="flex gap-2">
            <input
                x-model="kode"
                x-on:keydown.enter="validasi()"
                type="text"
                id="kode-voucher-input"
                placeholder="JPS-01-0001"
                class="flex-1 px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm font-mono focus:outline-none focus:border-gray-400 transition-colors uppercase"
                autofocus
            >
            <button
                x-on:click="validasi()"
                :disabled="loading"
                class="bg-gray-900 text-white text-sm font-medium px-5 py-3 rounded-lg hover:bg-gray-800 disabled:opacity-50 transition-all"
            >
                <span x-show="!loading">Cek</span>
                <span x-show="loading">...</span>
            </button>
        </div>
        <p class="text-xs text-gray-400 mt-2">Scan QR Code pelanggan atau ketik kode voucher secara manual, lalu tekan Enter.</p>
    </div>

    {{-- Result Panel --}}
    <div x-show="state !== null" x-cloak>

        {{-- STATE: VALID ✅ --}}
        <div x-show="state === 'valid'" class="bg-white rounded-xl border border-green-300 p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <div class="font-semibold text-green-800">Voucher Valid</div>
                    <div class="text-sm text-green-600" x-text="pesan"></div>
                </div>
            </div>

            <dl class="space-y-2 text-sm mb-5">
                <div class="flex justify-between"><dt class="text-gray-500">Kode</dt><dd class="font-mono font-medium" x-text="voucher?.kode"></dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">Pelanggan</dt><dd class="font-medium" x-text="voucher?.pelanggan"></dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">No. Telepon</dt><dd x-text="voucher?.nomor_telepon"></dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">Kategori</dt><dd x-text="voucher?.kategori"></dd></div>
            </dl>

            <div class="mb-3">
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-1.5">Keterangan Pemakaian</label>
                <input x-model="keterangan" type="text" placeholder="cth: Digunakan di Juara SPA Medan" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-gray-400 transition-colors">
            </div>

            <button x-on:click="gunakan()" :disabled="loadingGunakan"
                class="w-full bg-green-700 text-white text-sm font-semibold py-3 rounded-lg hover:bg-green-800 disabled:opacity-50 transition-colors">
                <span x-show="!loadingGunakan">Gunakan Voucher Ini</span>
                <span x-show="loadingGunakan">Memproses...</span>
            </button>
        </div>

        {{-- STATE: BERHASIL ✅✅ --}}
        <div x-show="state === 'berhasil'" class="bg-white rounded-xl border border-green-200 p-6 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="font-semibold text-green-800 text-lg">Voucher Berhasil Digunakan!</h3>
            <p class="text-sm text-green-600 mt-1" x-text="pesan"></p>
            <button x-on:click="reset()" class="mt-5 w-full bg-gray-900 text-white text-sm font-medium py-2.5 rounded-lg hover:bg-gray-800 transition-colors">
                Scan Voucher Berikutnya
            </button>
        </div>

        {{-- STATE: SUDAH TERPAKAI ⚠️ --}}
        <div x-show="state === 'sudah_terpakai'" class="bg-white rounded-xl border border-amber-300 p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <div class="font-semibold text-amber-800">Voucher Sudah Terpakai</div>
                    <div class="text-sm text-amber-600" x-text="pesan"></div>
                </div>
            </div>
            <template x-if="voucher">
                <dl class="space-y-1.5 text-sm bg-amber-50 rounded-lg p-3">
                    <div class="flex justify-between"><dt class="text-amber-700">Kode</dt><dd class="font-mono" x-text="voucher?.kode"></dd></div>
                    <div class="flex justify-between"><dt class="text-amber-700">Pelanggan</dt><dd x-text="voucher?.pelanggan"></dd></div>
                    <div class="flex justify-between"><dt class="text-amber-700">Kategori</dt><dd x-text="voucher?.kategori"></dd></div>
                    <div class="flex justify-between"><dt class="text-amber-700">Tgl Digunakan</dt><dd x-text="voucher?.tgl_digunakan"></dd></div>
                </dl>
            </template>
            <button x-on:click="reset()" class="mt-4 w-full border border-gray-200 text-sm font-medium py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                Cek Voucher Lain
            </button>
        </div>

        {{-- STATE: TIDAK DITEMUKAN ❌ --}}
        <div x-show="state === 'tidak_ditemukan'" class="bg-white rounded-xl border border-red-200 p-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <div>
                    <div class="font-semibold text-red-800">Voucher Tidak Ditemukan</div>
                    <div class="text-sm text-red-600" x-text="pesan"></div>
                </div>
            </div>
            <button x-on:click="reset()" class="mt-2 w-full border border-gray-200 text-sm font-medium py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                Coba Lagi
            </button>
        </div>

        {{-- STATE: ERROR --}}
        <div x-show="state === 'error'" class="bg-white rounded-xl border border-red-200 p-6 text-center">
            <p class="text-sm text-red-700" x-text="pesan"></p>
            <button x-on:click="reset()" class="mt-3 text-sm underline text-gray-500">Coba Lagi</button>
        </div>

    </div>
</div>

<script>
function scanVoucher() {
    return {
        kode: '',
        keterangan: '',
        state: null,
        pesan: '',
        voucher: null,
        loading: false,
        loadingGunakan: false,

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
                    body: JSON.stringify({ kode_voucher: this.kode.trim().toUpperCase() }),
                });

                const data = await res.json();
                this.state = data.state;
                this.pesan = data.pesan;
                this.voucher = data.voucher || null;
            } catch (e) {
                this.state = 'error';
                this.pesan = 'Terjadi kesalahan. Coba lagi.';
            } finally {
                this.loading = false;
            }
        },

        async gunakan() {
            if (!this.voucher?.id) return;
            if (!this.keterangan.trim()) {
                alert('Mohon isi keterangan pemakaian.');
                return;
            }
            this.loadingGunakan = true;

            try {
                const res = await fetch('{{ route('admin.scan.gunakan') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ voucher_id: this.voucher.id, keterangan: this.keterangan }),
                });

                const data = await res.json();
                this.state = data.state;
                this.pesan = data.pesan;
            } catch (e) {
                this.state = 'error';
                this.pesan = 'Gagal memproses. Coba lagi.';
            } finally {
                this.loadingGunakan = false;
            }
        },

        reset() {
            this.kode = '';
            this.keterangan = '';
            this.state = null;
            this.pesan = '';
            this.voucher = null;
            document.getElementById('kode-voucher-input').focus();
        },
    };
}
</script>
@endsection
