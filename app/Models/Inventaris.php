<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Pengajuan;

class Inventaris extends Model
{
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriInventaris::class, 'kategori_inventaris_id');
    }

    public function pengajuans()
    {
        return $this->belongsToMany(Pengajuan::class, 'pengajuan_items')
                    ->withPivot('jumlah', 'kondisi')
                    ->withTimestamps();
    }

    protected $fillable = ['kategori_inventaris_id', 'nama_inventaris', 'gambar_inventaris', 'deskripsi_inventaris', 'jumlah_inventaris', 'harga_inventaris', 'sewa_inventaris'];
}
