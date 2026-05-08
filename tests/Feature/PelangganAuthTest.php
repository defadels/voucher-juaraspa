<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PelangganAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_pelanggan_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/pelanggan/login');

        $response->assertStatus(200);
    }

    public function test_pelanggan_can_authenticate_using_email(): void
    {
        $pelanggan = User::factory()->pelanggan()->create();

        $response = $this->post('/pelanggan/login', [
            'login' => $pelanggan->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('pelanggan.beranda'));
    }

    public function test_pelanggan_can_authenticate_using_phone_number(): void
    {
        $pelanggan = User::factory()->pelanggan()->create([
            'nomor_telepon' => '081234567890',
        ]);

        $response = $this->post('/pelanggan/login', [
            'login' => '081234567890',
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('pelanggan.beranda'));
    }

    public function test_pelanggan_cannot_authenticate_with_invalid_password(): void
    {
        $pelanggan = User::factory()->pelanggan()->create();

        $this->post('/pelanggan/login', [
            'login' => $pelanggan->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_admin_cannot_login_to_pelanggan_portal(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->post('/pelanggan/login', [
            'login' => $admin->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('login');
    }

    public function test_pelanggan_can_logout(): void
    {
        $pelanggan = User::factory()->pelanggan()->create();
        $this->actingAs($pelanggan);

        $response = $this->post('/pelanggan/logout');

        $this->assertGuest();
        $response->assertRedirect('/pelanggan/login');
    }
}
