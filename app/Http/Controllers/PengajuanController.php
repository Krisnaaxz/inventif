<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengajuanRequest;
use App\Models\Inventaris;
use App\Models\Pengajuan;
use App\View\Components\ConfirmDelete;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public $pageTitle = 'Data Pengajuan';

    public function index()
    {
        $pageTitle = $this->pageTitle;
        $query = Pengajuan::query();
        $perPage = request()->query('perPage') ?? 10;
        $query->with(['user:id,name,email,role', 'inventaris:id,nama_inventaris,kategori_inventaris_id']);
        $search = request()->query('search');

        if ($search) {
            $query->where('status', 'like', '%' . $search . '%');
        }

        // Admin melihat semua pengajuan
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->user()->id);
        }
        ConfirmDelete('Apakah Anda yakin ingin menghapus pengajuan ini?');
        $pengajuans = $query->orderBy('tanggal_pengajuan', 'desc')->paginate($perPage)->appends(request()->query());
        return view('pengajuan.index', compact('pageTitle', 'pengajuans'));
    }

    public function peminjaman()
    {
        $pageTitle = 'Peminjaman Inventaris';
        $query = Pengajuan::query();
        $perPage = request()->query('perPage') ?? 10;
        $query->with(['user:id,name,email,role', 'inventaris:id,nama_inventaris,kategori_inventaris_id']);
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
        ConfirmDelete('Apakah Anda yakin ingin menghapus pengajuan ini?');
        $pengajuans = $query->orderBy('tanggal_pengajuan', 'desc')->paginate($perPage)->appends(request()->query());
        return view('pengajuan.peminjaman', compact('pageTitle', 'pengajuans', 'inventaris'));
    }

    public function penyewaan()
    {
        $pageTitle = 'Penyewaan Inventaris';
        $query = Pengajuan::query();
        $perPage = request()->query('perPage') ?? 10;
        $query->with(['user:id,name,email,role', 'inventaris:id,nama_inventaris,kategori_inventaris_id']);
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
        ConfirmDelete('Apakah Anda yakin ingin menghapus pengajuan ini?');
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
            'durasi_sewa' => $request->jenis === 'penyewaan' ? $request->durasi_sewa : null,
            'total_biaya' => $request->jenis === 'penyewaan' ? $request->total_biaya : null,
            'alasan' => $request->keperluan,
            'surat_pengajuan' => $request->file('surat_pengajuan') ? $request->file('surat_pengajuan')->store('surat_pengajuan', 'public') : null,
            'tanggal_pengajuan' => now(),
        ]);

        // Attach inventaris items with quantities
        if ($request->has('inventaris_ids') && is_array($request->inventaris_ids)) {
            $inventarisData = [];
            $jumlahData = $request->input('jumlah', []);

            foreach ($request->inventaris_ids as $inventarisId) {
                $jumlah = isset($jumlahData[$inventarisId]) ? (int) $jumlahData[$inventarisId] : 1;
                $inventarisData[$inventarisId] = [
                    'jumlah' => $jumlah,
                    'kondisi' => 'baik', // Default kondisi
                ];
            }
            $pengajuan->inventaris()->attach($inventarisData);
        }

        toast()->success('Pengajuan ' . $request->jenis . ' berhasil dikirim.');
        return redirect()->route('pengajuan.' . $request->jenis);
    }

    public function cancel($action, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'dibatalkan';
        $pengajuan->save();

        toast()->success('Pengajuan berhasil dibatalkan.');
        return redirect()->route('pengajuan.' . $action);
    }
    public function approve($action, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'disetujui';
        $pengajuan->approved_by = auth()->user()->id;
        $pengajuan->approved_at = now();
        $pengajuan->save();

        toast()->success('Pengajuan berhasil disetujui.');
        return redirect()->route('pengajuan.' . $action);
    }
    public function reject($action, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'ditolak';
        $pengajuan->save();

        toast()->success('Pengajuan berhasil ditolak.');
        return redirect()->route('pengajuan.' . $action);
    }
    public function selesai($action, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'selesai';
        $pengajuan->returned_at = now();
        $pengajuan->save();

        toast()->success('Pengajuan berhasil diselesaikan.');
        return redirect()->route('pengajuan.' . $action);
    }
    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->inventaris()->detach(); // Detach related inventaris
        $pengajuan->delete();

        toast()->success('Pengajuan berhasil dihapus.');
        return redirect()->back();
    }
}
