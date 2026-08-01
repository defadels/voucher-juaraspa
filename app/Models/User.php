<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'nomor_telepon',
        'role',
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /** Voucher yang dimiliki sebagai pelanggan */
    public function voucherSebagaiPelanggan(): HasMany
    {
        return $this->hasMany(Voucher::class, 'pelanggan_id', 'id');
    }

    /** Voucher yang diterbitkan oleh admin ini */
    public function voucherDiterbitkan(): HasMany
    {
        return $this->hasMany(Voucher::class, 'admin_id', 'id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPelanggan(): bool
    {
        return $this->role === 'pelanggan';
    }
}
