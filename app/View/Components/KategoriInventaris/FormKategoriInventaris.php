<?php

namespace App\View\Components\KategoriInventaris;

use App\Http\Controllers\KategoriInventarisController;
use App\Models\KategoriInventaris;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormKategoriInventaris extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $nama_kategori, $action;
    public function __construct($id = null)
    {
        if($id){
            $kategori = KategoriInventaris::findOrFail($id);
            $this->id = $kategori->id;
            $this->nama_kategori = $kategori->nama_kategori;
            $this->action = route('inventaris.kategori-inventaris.update', $kategori->id);
        }
        else{
            $this->action = route('inventaris.kategori-inventaris.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.kategori-inventaris.form-kategori-inventaris');
    }
}