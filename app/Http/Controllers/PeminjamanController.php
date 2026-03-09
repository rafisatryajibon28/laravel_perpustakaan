<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['buku', 'anggota']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $peminjaman = $query->latest()->paginate(10);

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $buku = Buku::tersedia()->get();
        $anggota = Anggota::aktif()->get();

        return view('peminjaman.create', compact('buku', 'anggota'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_buku' => 'required|exists:bukus,id',
            'id_anggota' => 'required|exists:anggotas,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after:tanggal_pinjam',
        ]);

        $buku = Buku::find($request->id_buku);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku tidak tersedia!');
        }

        $buku->stok -= 1;
        $buku->save();

        Peminjaman::create([
            'id_buku' => $request->id_buku,
            'id_anggota' => $request->id_anggota,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'dipinjam',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function kembali(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status == 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan!');
        }

        $validated = $request->validate([
            'tanggal_kembali' => 'required|date',
        ]);

        $tanggalKembali = Carbon::parse($validated['tanggal_kembali']);
        $jatuhTempo = Carbon::parse($peminjaman->tanggal_jatuh_tempo);

        $denda = 0;
        $status = 'dikembalikan';

        if ($tanggalKembali > $jatuhTempo) {
            $hariTerlambat = $tanggalKembali->diffInDays($jatuhTempo);
            $denda = $hariTerlambat * 1000;
            $status = 'terlambat';
        }

        $peminjaman->update([
            'tanggal_kembali' => $tanggalKembali,
            'status' => $status,
            'denda' => $denda,
        ]);

        $buku = Buku::find($peminjaman->id_buku);
        $buku->stok += 1;
        $buku->save();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Pengembalian berhasil! Denda: Rp ' . number_format($denda, 0, ',', '.'));
    }

    public function laporan()
    {
        $totalBuku = Buku::count();
        $totalAnggotaAktif = Anggota::aktif()->count();
        $bukuDipinjam = Peminjaman::whereIn('status', ['dipinjam', 'terlambat'])->count();
        $bukuTerlambat = Peminjaman::where('status', 'terlambat')->count();

        $peminjamanAktif = Peminjaman::with(['buku', 'anggota'])
            ->whereIn('status', ['dipinjam', 'terlambat'])
            ->latest()
            ->get();

        return view('peminjaman.laporan', compact(
            'totalBuku', 'totalAnggotaAktif', 'bukuDipinjam', 'bukuTerlambat', 'peminjamanAktif'
        ));
    }
}