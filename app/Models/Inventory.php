<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    /**
     * [PERBAIKAN] Daftarkan semua kolom yang boleh diisi di sini.
     */
    protected $fillable = [
        'panen_id',
        'batch_code',
        'distributor_id',
        'peternak_id',
        'tanggal_panen',
        'jumlah_ayam',
        'jenis_produk',
        'harga_per_ekor',
        'status',
    ];

    /**
     * Relasi ke user peternak.
     */
    public function peternak()
    {
        return $this->belongsTo(User::class, 'peternak_id');
    }

    /**
     * Relasi ke user distributor.
     */
    public function distributor()
    {
        return $this->belongsTo(User::class, 'distributor_id');
    }
}
