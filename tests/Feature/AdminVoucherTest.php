<?php

namespace Tests\Feature;

use App\Models\KategoriVoucher;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminVoucherTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_kirim_voucher_page(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('admin.voucher.kirim'));

        $response->assertStatus(200);
    }

    public function test_admin_can_send_vouchers_to_pelanggan(): void
    {
        $admin = User::factory()->admin()->create();
        $pelanggan = User::factory()->pelanggan()->create();
        $kategori = KategoriVoucher::factory()->create();

        $response = $this->actingAs($admin)->post(route('admin.voucher.store'), [
            'pelanggan_id' => $pelanggan->id,
            'kategori_id' => $kategori->id,
            'jumlah' => 3,
            'tgl_terbit' => now()->format('Y-m-d'),
        ]);

        $response->assertRedirect(route('admin.voucher.index'));
        $this->assertDatabaseCount('voucher', 3);
        $this->assertDatabaseHas('voucher', [
            'pelanggan_id' => $pelanggan->id,
            'kategori_id' => $kategori->id,
            'status' => 'aktif',
        ]);
    }

    public function test_admin_can_validate_voucher(): void
    {
        $admin = User::factory()->admin()->create();
        $voucher = Voucher::factory()->aktif()->create();

        $response = $this->actingAs($admin)->postJson(route('admin.scan.validasi'), [
            'kode_voucher' => $voucher->kode_voucher,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'state' => 'valid',
            ]);
    }

    public function test_admin_can_use_voucher(): void
    {
        $admin = User::factory()->admin()->create();
        $voucher = Voucher::factory()->aktif()->create();

        $response = $this->actingAs($admin)->postJson(route('admin.scan.gunakan'), [
            'voucher_id' => $voucher->id,
            'keterangan' => 'Test penggunaan voucher',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'state' => 'berhasil',
            ]);

        $this->assertDatabaseHas('voucher', [
            'id' => $voucher->id,
            'status' => 'terpakai',
        ]);

        $this->assertDatabaseHas('voucher_usage', [
            'voucher_id' => $voucher->id,
            'keterangan' => 'Test penggunaan voucher',
        ]);
    }
}
