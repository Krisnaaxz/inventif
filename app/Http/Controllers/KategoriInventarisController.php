<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeKategoriInventarisRequest;
use App\Http\Requests\updateKategoriInventarisRequest;
use App\Models\KategoriInventaris;
use Illuminate\Http\Request;

class KategoriInventarisController extends Controller
{
    public $pageTitle = 'Kategori Inventaris';
    public function index()
    {
        $pageTitle = $this->pageTitle;
        $perPage = request()->query('perPage') ?? 10;
        $search = request()->query('search');
        $query = KategoriInventaris::query();

        if ($search) {
            $query = KategoriInventaris::where('nama_kategori', 'like', '%' . $search . '%');
        } else {
            $query = KategoriInventaris::query();
        }

        $kategori = $query->paginate($perPage)->appends(request()->query());
        confirmDelete('Apakah Anda yakin ingin menghapus kategori inventaris ini?');
        return view('kategori-inventaris.index', compact('pageTitle', 'kategori'));
    }

    public function store(storeKategoriInventarisRequest $request)
    {
        KategoriInventaris::create([
            'nama_kategori' => $request->nama_kategori
        ]);
        toast()->success('Berhasil menambahkan kategori inventaris.');
        return redirect()->route('inventaris.kategori-inventaris.index');
    }

    public function update(updateKategoriInventarisRequest $request, $id)
    {
        $kategoriInventaris = KategoriInventaris::findOrFail($id);
        $kategoriInventaris->nama_kategori = $request->nama_kategori;
        $kategoriInventaris->save();
        toast()->success('Berhasil memperbarui kategori inventaris.');
        return redirect()->route('inventaris.kategori-inventaris.index');
    }

    public function destroy($id)
    {
        $kategoriInventaris = KategoriInventaris::findOrFail($id);
        $kategoriInventaris->delete();
        toast()->success('Berhasil menghapus kategori inventaris.');
        return redirect()->route('inventaris.kategori-inventaris.index');
    }
}