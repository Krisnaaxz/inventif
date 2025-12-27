<?php

namespace App\Http\Controllers;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public $pageTitle = 'Data Inventaris';
    public function index()
    {
        $query = Inventaris::query();
        $perPage = request()->query('perPage') ?? 10;
        $pageTitle = $this->pageTitle;
        $query->with('kategori:id,nama_kategori');
        $search = request()->query('search');

        if ($search) {
            $query = Inventaris::where('nama_inventaris', 'like', '%' . $search . '%');
        }

        $inventaris = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends(request()->query());
        confirmDelete('Apakah Anda yakin ingin menghapus data inventaris ini?');
        return view('daftar-inventaris.index', compact('pageTitle', 'inventaris'));
    }
}
