<?php

namespace App\View\Components\pengajuan;

use App\Models\Pengajuan;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormPeminjaman extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $user_id, $jenis, $status, $tanggal_mulai, $tanggal_selesai, $waktu_mulai, $waktu_selesai, $alasan, $durasi_sewa, $surat_pengajuan, $tanggal_pengajuan, $approved_by, $approved_at, $returned_at, $action, $inventaris;

    public function __construct($inventaris = null, $id = null)
    {
        $this->inventaris = $inventaris;

        // Debug: check if inventaris is received
        // if ($inventaris) {
        //     \Log::info('Inventaris received in component: ' . $inventaris->count());
        // } else {
        //     \Log::info('No inventaris received in component');
        // }
        
        if($id){
            $peminjaman = Pengajuan::findOrFail($id);
            $this->id = $peminjaman->id;
            $this->user_id = $peminjaman->user_id;
            $this->jenis = $peminjaman->jenis;
            $this->status = $peminjaman->status;
            $this->tanggal_mulai = $peminjaman->tanggal_mulai;
            $this->tanggal_selesai = $peminjaman->tanggal_selesai;
            $this->waktu_mulai = $peminjaman->waktu_mulai;
            $this->waktu_selesai = $peminjaman->waktu_selesai;
            $this->alasan = $peminjaman->alasan;
            $this->durasi_sewa = $peminjaman->durasi_sewa;
            $this->surat_pengajuan = $peminjaman->surat_pengajuan;
            $this->tanggal_pengajuan = $peminjaman->tanggal_pengajuan;
            $this->approved_by = $peminjaman->approved_by;
            $this->approved_at = $peminjaman->approved_at;
            $this->returned_at = $peminjaman->returned_at;
            $this->action = route('pengajuan.update', $id);
        } else {
            $this->action = route('pengajuan.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pengajuan.form-peminjaman', [
            'inventaris' => $this->inventaris
        ]);
    }
}
