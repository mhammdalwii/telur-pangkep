<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_code',
        'user_id',
        'tanggal_panen',
        'asal_kandang',
        'jumlah_ayam',
        'jenis_produk',
        'harga_per_ekor',
        'status',
    ];

    // Relasi ke User (Peternak)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
