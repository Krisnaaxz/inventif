<?php

namespace App\View\Components\pengajuan;

use App\Models\Pengajuan;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormPenyewaan extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $user_id, $jenis, $status, $tanggal_mulai, $tanggal_selesai, $waktu_mulai, $waktu_selesai, $alasan, $durasi_sewa, $surat_pengajuan, $tanggal_pengajuan, $approved_by, $approved_at, $returned_at, $action, $inventaris;

    public function __construct($inventaris = null, $id = null)
    {
        $this->inventaris = $inventaris;

        if($id){
            $penyewaan = Pengajuan::findOrFail($id);
            $this->id = $penyewaan->id;
            $this->user_id = $penyewaan->user_id;
            $this->jenis = $penyewaan->jenis;
            $this->status = $penyewaan->status;
            $this->tanggal_mulai = $penyewaan->tanggal_mulai;
            $this->tanggal_selesai = $penyewaan->tanggal_selesai;
            $this->waktu_mulai = $penyewaan->waktu_mulai;
            $this->waktu_selesai = $penyewaan->waktu_selesai;
            $this->alasan = $penyewaan->alasan;
            $this->durasi_sewa = $penyewaan->durasi_sewa;
            $this->surat_pengajuan = $penyewaan->surat_pengajuan;
            $this->tanggal_pengajuan = $penyewaan->tanggal_pengajuan;
            $this->approved_by = $penyewaan->approved_by;
            $this->approved_at = $penyewaan->approved_at;
            $this->returned_at = $penyewaan->returned_at;
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
        return view('components.pengajuan.form-penyewaan', [
            'inventaris' => $this->inventaris
        ]);
    }
}
