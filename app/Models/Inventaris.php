<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    public function kategoriInventaris()
    {
        return $this->belongsTo(KategoriInventaris::class);
    }
}