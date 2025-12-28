<?php

namespace App\View\Components\pengajuan;

use App\Models\Pengajuan;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmPengajuan extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $route;
    public function __construct($id, $route)
    {
        $pengajuan = Pengajuan::find($id);
        $message = "Konfirmasi Pengajuan " . ucfirst($pengajuan->jenis) . "\n";
        $message .= "Nama: " . $pengajuan->user->name . "\n";
        $message .= "Tanggal: " . $pengajuan->tanggal_mulai->format('d M Y') . " - " . $pengajuan->tanggal_selesai->format('d M Y') . "\n";
        if ($pengajuan->jenis === 'penyewaan') {
            $message .= "Total Biaya: Rp " . number_format($pengajuan->total_biaya, 0, ',', '.') . "\n";
        }
        $message .= "Status: " . ucfirst($pengajuan->status);
        $this->route = $route . '?text=' . urlencode($message);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pengajuan.confirm-pengajuan');
    }
}
