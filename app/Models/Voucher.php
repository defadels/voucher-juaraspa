<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\KategoriVoucher;


class Voucher extends Model
{
    protected $table = 'voucher';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamp = true;

    public $fillable = [
        'kode_voucher',
        'kategori_id',
        'pelanggan_id',
        'admin_id',
        'qr_code_path',
        'tgl_terbit',
        'status'
    ];

    public function pelanggan(): BelongsTo {
        return $this->belongsTo(User::class, 'pelanggan_id', 'id');
    }
  
    public function admin(): BelongsTo {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriVoucher::class, 'kategori_id', 'id');
    }
}
