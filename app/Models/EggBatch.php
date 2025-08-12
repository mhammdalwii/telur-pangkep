<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EggBatch extends Model
{
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
