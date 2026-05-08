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
        Schema::create('voucher_usage', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_digunakan')->nullable(false);
            $table->string('keterangan')->nullable(false);
            $table->unsignedBigInteger('voucher_id')->nullable(false);
            $table->foreign('voucher_id')->on('voucher')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_usage');
    }
};
