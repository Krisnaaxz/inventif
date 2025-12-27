<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    public function kategori()
    {
        return $this->belongsTo(KategoriInventaris::class, 'kategori_inventaris_id');
    }

    protected $fillable = ['kategori_inventaris_id', 'nama_inventaris', 'gambar_inventaris', 'deskripsi_inventaris', 'jumlah_inventaris', 'harga_inventaris', 'sewa_inventaris'];
}
