<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_voucher', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori')->nullable(false);
            $table->string('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('voucher', function (Blueprint $table) {
            $table->id();
            $table->string('kode_voucher')->nullable(false);
            $table->string('qr_code_path')->nullable(false);
            $table->date('tgl_terbit')->nullable(false);
            $table->unsignedBigInteger('pelanggan_id')->nullable(false);
            $table->unsignedBigInteger('admin_id')->nullable(false);
            $table->unsignedBigInteger('kategori_id')->nullable(false);
            $table->timestamps();
            $table->enum('status', ['aktif', 'terpakai'])->default('aktif');
            $table->foreign('kategori_id')->on('kategori_voucher')->references('id');
            $table->foreign('pelanggan_id')->on('users')->references('id');
            $table->foreign('admin_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_voucher');
        Schema::dropIfExists('voucher');
    }
};
