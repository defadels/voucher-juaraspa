<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoucherUsage extends Model
{
    protected $table = 'voucher_usage';

    /** @var list<string> */
    public $fillable = [
        'voucher_id',
        'tgl_digunakan',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tgl_digunakan' => 'date',
        ];
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }
}
