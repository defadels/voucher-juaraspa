<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Voucher;

class VoucherUsage extends Model
{
    protected $table = 'voucher_usage';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $incrementing = true;
    public $timestamp = true;

    public $fillable = [
        'voucher_id',
        'tgl_digunakan',
        'keterangan'
    ];

    public function voucher(): BelongsTo {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }
}
