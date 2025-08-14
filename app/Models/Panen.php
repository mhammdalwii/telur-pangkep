<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    // Event untuk set nilai otomatis sebelum membuat data
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($panen) {
            if (empty($panen->batch_code)) {
                $prefix = 'PN-' . now()->format('Ymd');
                $panen->batch_code = $prefix . '-' . Str::upper(Str::random(4));
            }

            if (empty($panen->status)) {
                $panen->status = 'Siap Kirim';
            }

            if (empty($panen->user_id)) {
                $panen->user_id = Auth::id();
            }
        });
    }

    public function distributor()
    {
        // Relasi ke tabel 'users' berdasarkan kolom 'distributor_id'
        return $this->belongsTo(User::class, 'distributor_id');
    }
}
