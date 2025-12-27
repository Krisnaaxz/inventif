<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeInventarisRequest;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function store(storeInventarisRequest $request)
    {
        $fileName = time() . '_' . $request->file('gambar_inventaris')->getClientOriginalName();
        Storage::disk('public')->putFileAs('inventaris', $request->file('gambar_inventaris'), $fileName);
        $inventaris = Inventaris::create([
            'nama_inventaris' => $request->nama_inventaris,
            'deskripsi_inventaris' => $request->deskripsi_inventaris,
            'kategori_inventaris_id' => $request->kategori_inventaris_id,
            'jumlah_inventaris' => $request->jumlah_inventaris,
            'harga_inventaris' => $request->harga_inventaris,
            'sewa_inventaris' => $request->sewa_inventaris,
            'gambar_inventaris' => $fileName,
        ]);
        toast()->success('Berhasil menambahkan data inventaris.');
        return redirect()->route('inventaris.daftar-inventaris.show', $inventaris->id);
    }

    public function show($daftar_inventari)
    {
        $inventaris = Inventaris::with('kategori')->findOrFail($daftar_inventari);
        $pageTitle = $this->pageTitle;
        return view('daftar-inventaris.show', compact('inventaris', 'pageTitle'));
    }

    public function update(storeInventarisRequest $request, $id)
    {
        $inventaris = Inventaris::findOrFail($id);

        if ($request->hasFile('gambar_inventaris')) {
            // Hapus gambar lama jika ada
            if ($inventaris->gambar_inventaris) {
                Storage::disk('public')->delete('inventaris/' . $inventaris->gambar_inventaris);
            }
            $fileName = time() . '_' . $request->file('gambar_inventaris')->getClientOriginalName();
            Storage::disk('public')->putFileAs('inventaris', $request->file('gambar_inventaris'), $fileName);
            $inventaris->gambar_inventaris = $fileName;
        }

        $inventaris->nama_inventaris = $request->nama_inventaris;
        $inventaris->deskripsi_inventaris = $request->deskripsi_inventaris;
        $inventaris->kategori_inventaris_id = $request->kategori_inventaris_id;
        $inventaris->jumlah_inventaris = $request->jumlah_inventaris;
        $inventaris->harga_inventaris = $request->harga_inventaris;
        $inventaris->sewa_inventaris = $request->sewa_inventaris;
        $inventaris->save();

        toast()->success('Berhasil memperbarui data inventaris.');
        return redirect()->route('inventaris.daftar-inventaris.index');
    }

    public function destroy($id )
    {
        $inventaris = Inventaris::findOrFail($id);
        $inventaris->delete();
        toast()->success('Berhasil menghapus data inventaris.');
        return redirect()->route('inventaris.daftar-inventaris.index');
    }
}
