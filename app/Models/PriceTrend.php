<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceTrend extends Model
{
    use HasFactory;

    /**
     * Atribut yang bisa diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'farmer_price',
        'distributor_price',
    ];

    /**

     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
    ];
}
