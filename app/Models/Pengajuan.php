<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
        'alasan',
        'durasi_sewa',
        'surat_pengajuan',
        'tanggal_pengajuan',
        'approved_by',
        'approved_at',
        'returned_at',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'approved_at' => 'datetime',
        'returned_at' => 'datetime',
        'jenis' => 'string',
        'status' => 'string',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inventaris(): BelongsTo
    {
        return $this->belongsTo(Inventaris::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Accessors
    public function getIsPeminjamanAttribute(): bool
    {
        return $this->jenis === 'peminjaman';
    }

    public function getIsPenyewaanAttribute(): bool
    {
        return $this->jenis === 'penyewaan';
    }

    public function getIsMenungguAttribute(): bool
    {
        return $this->status === 'menunggu';
    }

    public function getIsDisetujuiAttribute(): bool
    {
        return $this->status === 'disetujui';
    }

    public function getIsSelesaiAttribute(): bool
    {
        return $this->status === 'selesai';
    }

    // Scopes
    public function scopePeminjaman($query)
    {
        return $query->where('jenis', 'peminjaman');
    }

    public function scopePenyewaan($query)
    {
        return $query->where('jenis', 'penyewaan');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'menunggu');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'disetujui');
    }
}
