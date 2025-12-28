<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengajuanRequest;
use App\Models\Inventaris;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public $pageTitle = 'Data Pengajuan';

    public function index()
    {
        $pageTitle = $this->pageTitle;
        $query = Pengajuan::query();
        $perPage = request()->query('perPage') ?? 10;
        $query->with('user:id,name,email,role');
        $search = request()->query('search');

        if ($search) {
            $query->where('status', 'like', '%' . $search . '%');
        }

        // Admin melihat semua pengajuan
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->user()->id);
        }

        $pengajuans = $query->orderBy('tanggal_pengajuan', 'desc')->paginate($perPage)->appends(request()->query());
        return view('pengajuan.index', compact('pageTitle', 'pengajuans'));
    }

    public function peminjaman()
    {
        $pageTitle = 'Peminjaman Inventaris';
        $query = Pengajuan::query();
        $perPage = request()->query('perPage') ?? 10;
        $query->with('user:id,name,email,role');
        $search = request()->query('search');
        $inventaris = Inventaris::with('kategori:id,nama_kategori')->get();

        // Filter hanya peminjaman
        $query->where('jenis', 'peminjaman');

        if ($search) {
            $query->where('status', 'like', '%' . $search . '%');
        }

        // Jika bukan admin, hanya tampilkan pengajuan user sendiri
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->user()->id);
        }

        $pengajuans = $query->orderBy('tanggal_pengajuan', 'desc')->paginate($perPage)->appends(request()->query());
        return view('pengajuan.peminjaman', compact('pageTitle', 'pengajuans', 'inventaris'));
    }

    public function penyewaan()
    {
        $pageTitle = 'Penyewaan Inventaris';
        $query = Pengajuan::query();
        $perPage = request()->query('perPage') ?? 10;
        $query->with('user:id,name,email,role');
        $search = request()->query('search');
        $inventaris = Inventaris::with('kategori:id,nama_kategori')->get();

        // Filter hanya penyewaan
        $query->where('jenis', 'penyewaan');

        if ($search) {
            $query->where('status', 'like', '%' . $search . '%');
        }

        // Jika bukan admin, hanya tampilkan pengajuan user sendiri
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->user()->id);
        }

        $pengajuans = $query->orderBy('tanggal_pengajuan', 'desc')->paginate($perPage)->appends(request()->query());
        return view('pengajuan.penyewaan', compact('pageTitle', 'pengajuans', 'inventaris'));
    }

    public function store(StorePengajuanRequest $request)
    {
        $pengajuan = Pengajuan::create([
            'user_id' => auth()->user()->id,
            'jenis' => $request->jenis,
            'status' => 'menunggu',
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'alasan' => $request->keperluan,
            'surat_pengajuan' => $request->file('surat_pengajuan') ? $request->file('surat_pengajuan')->store('surat_pengajuan', 'public') : null,
            'tanggal_pengajuan' => now(),
        ]);

        // Attach inventaris items
        if ($request->has('inventaris_ids') && is_array($request->inventaris_ids)) {
            $inventarisData = [];
            foreach ($request->inventaris_ids as $inventarisId) {
                $inventarisData[$inventarisId] = [
                    'jumlah' => 1, // Default jumlah
                    'kondisi' => 'baik', // Default kondisi
                ];
            }
            $pengajuan->inventaris()->attach($inventarisData);
        }

        toast()->success('Pengajuan ' . $request->jenis . ' berhasil dikirim.');
        return redirect()->route('pengajuan.' . $request->jenis);
    }
}
