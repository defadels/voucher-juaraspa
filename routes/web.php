<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriVoucherController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\ScanController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\PelangganLoginController;
use App\Http\Controllers\Pelanggan\DashboardController as PelangganDashboard;
use App\Http\Controllers\Pelanggan\ProfilController;
use App\Http\Controllers\Pelanggan\VoucherController as PelangganVoucher;
use Illuminate\Support\Facades\Route;

// ─── ROOT LANDING PAGE ────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('landing');

// ─── ADMIN AUTH ───────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminLoginController::class, 'create'])->name('login');
        Route::post('login', [AdminLoginController::class, 'store']);
    });

    Route::post('logout', [AdminLoginController::class, 'destroy'])->name('logout');

    // Admin dashboard (hanya role admin)
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Pelanggan management
        Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
        Route::get('pelanggan/buat', [PelangganController::class, 'create'])->name('pelanggan.create');
        Route::post('pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
        Route::get('pelanggan/{pelanggan}', [PelangganController::class, 'show'])->name('pelanggan.show');
        Route::post('pelanggan/{pelanggan}/reset-password', [PelangganController::class, 'resetPassword'])->name('pelanggan.reset-password');

        // Voucher management
        Route::get('voucher', [VoucherController::class, 'index'])->name('voucher.index');
        Route::get('voucher/kirim', [VoucherController::class, 'kirim'])->name('voucher.kirim');
        Route::post('voucher', [VoucherController::class, 'store'])->name('voucher.store');
        Route::get('voucher/riwayat', [VoucherController::class, 'riwayat'])->name('voucher.riwayat');

        // Scan
        Route::get('scan', [ScanController::class, 'index'])->name('scan');
        Route::post('scan/validasi', [ScanController::class, 'validasi'])->name('scan.validasi');
        Route::post('scan/gunakan', [ScanController::class, 'gunakan'])->name('scan.gunakan');

        // Kategori Voucher management
        Route::resource('kategori-voucher', KategoriVoucherController::class)->names('kategori-voucher');

        // Laporan
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');

        // Pengaturan
        Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
        Route::post('pengaturan/profil', [PengaturanController::class, 'updateProfil'])->name('pengaturan.profil');
        Route::post('pengaturan/password', [PengaturanController::class, 'updatePassword'])->name('pengaturan.password');
    });
});

// ─── PELANGGAN AUTH ────────────────────────────────────────────────────────────
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [PelangganLoginController::class, 'create'])->name('login');
        Route::post('login', [PelangganLoginController::class, 'store']);
    });

    Route::post('logout', [PelangganLoginController::class, 'destroy'])->name('logout');

    // Pelanggan dashboard (hanya role pelanggan)
    Route::middleware(['auth', 'role:pelanggan'])->group(function () {
        Route::get('beranda', [PelangganDashboard::class, 'index'])->name('beranda');

        Route::get('voucher', [PelangganVoucher::class, 'index'])->name('voucher.index');
        Route::get('voucher/{voucher}', [PelangganVoucher::class, 'show'])->name('voucher.show');
        Route::get('riwayat', [PelangganVoucher::class, 'riwayat'])->name('riwayat');

        Route::get('profil', [ProfilController::class, 'index'])->name('profil');
        Route::post('profil', [ProfilController::class, 'update'])->name('profil.update');
        Route::post('profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');

        Route::get('bantuan', fn () => view('pelanggan.bantuan'))->name('bantuan');
    });
});
