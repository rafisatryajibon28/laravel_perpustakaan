<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::latest()->paginate(15);
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis'             => 'required|unique:anggotas,nis|max:20',
            'nama_lengkap'    => 'required|max:255',
            'kelas'           => 'required|max:50',
            'jenis_kelamin'   => 'required|in:L,P',
            'alamat'          => 'required',
            'no_telepon'      => 'required|max:20',
            'email'           => 'required|email|unique:anggotas,email',
            'tanggal_daftar'  => 'required|date',
            'status_aktif'    => 'boolean',
        ]);

        Anggota::create($validated);

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function show(Anggota $anggota)
    {
        return view('anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'nis'             => 'required|max:20|unique:anggotas,nis,' . $anggota->id,
            'nama_lengkap'    => 'required|max:255',
            'kelas'           => 'required|max:50',
            'jenis_kelamin'   => 'required|in:L,P',
            'alamat'          => 'required',
            'no_telepon'      => 'required|max:20',
            'email'           => 'required|email|unique:anggotas,email,' . $anggota->id,
            'tanggal_daftar'  => 'required|date',
            'status_aktif'    => 'boolean',
        ]);

        $anggota->update($validated);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus!');
    }
}