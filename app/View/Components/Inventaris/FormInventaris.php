<?php

namespace App\View\Components\Inventaris;

use App\Models\Inventaris;
use App\Models\KategoriInventaris;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInventaris extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $nama_inventaris, $deskripsi_inventaris, $jumlah_inventaris, $harga_inventaris, $sewa_inventaris, $kategori_inventaris_id, $kategori_inventaris, $action;
    public function __construct($id =null)
    {
        $this->kategori_inventaris = KategoriInventaris::all();
        if ($id) {
            $inventaris = Inventaris::findOrFail($id);
            $this->id = $inventaris->id;
            $this->nama_inventaris = $inventaris->nama_inventaris;
            $this->deskripsi_inventaris = $inventaris->deskripsi_inventaris;
            $this->jumlah_inventaris = $inventaris->jumlah_inventaris;
            $this->harga_inventaris = $inventaris->harga_inventaris;
            $this->sewa_inventaris = $inventaris->sewa_inventaris;
            $this->kategori_inventaris_id = $inventaris->kategori_inventaris_id;
            $this->action = route('inventaris.daftar-inventaris.update', $id);
        } else {
            $this->action = route('inventaris.daftar-inventaris.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inventaris.form-inventaris');
    }
}
