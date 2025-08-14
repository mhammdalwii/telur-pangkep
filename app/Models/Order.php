<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user() // Relasi ke Pedagang
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function distributor() // Relasi ke Distributor
    {
        return $this->belongsTo(User::class, 'distributor_id');
    }
}
