<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetailModel extends Model
{
    use HasFactory;

    protected $table = 'transaksi_detail';
    protected $fillable = [
        "no_transaksi",
        "produk_id",
        "harga",
        "jumlah",
    ];

    public function produk()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }
}
