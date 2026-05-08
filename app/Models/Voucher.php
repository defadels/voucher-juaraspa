<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'voucher';

    /** @var list<string> */
    public $fillable = [
        'kode_voucher',
        'kategori_id',
        'pelanggan_id',
        'admin_id',
        'qr_code_path',
        'tgl_terbit',
        'status',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pelanggan_id', 'id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriVoucher::class, 'kategori_id', 'id');
    }

    public function usages(): HasMany
    {
        return $this->hasMany(VoucherUsage::class, 'voucher_id', 'id');
    }

    public function isAktif(): bool
    {
        return $this->status === 'aktif';
    }

    public function isTerpakai(): bool
    {
        return $this->status === 'terpakai';
    }
}
