<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriVoucher extends Model
{
    protected $table = 'kategori_voucher';
    protected $primaryKey = 'id';
    protected $keyType = "int";
    protected $timestamp = true;
    public $incrementing = true;

    public $fillable = [
        'nama_kategori',
        'deskripsi'
    ];


}
