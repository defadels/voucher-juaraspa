<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriVoucher extends Model
{
    use HasFactory;

    protected $table = 'kategori_voucher';

    /** @var list<string> */
    public $fillable = [
        'nama_kategori',
        'prefix',
        'deskripsi',
    ];

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class, 'kategori_id', 'id');
    }
}
