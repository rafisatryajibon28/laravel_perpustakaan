<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BukuRequest; 

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();

        if ($request->cari) {
            $query->where('judul', 'like', '%' . $request->cari . '%')
                  ->orWhere('penulis', 'like', '%' . $request->cari . '%');
        }

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        $buku = $query->paginate(12);
        $kategoriList = Buku::distinct()->pluck('kategori');

        return view('buku.index', compact('buku', 'kategoriList'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(BukuRequest $request) 
    {
        $data = $request->validated(); 

        if ($request->hasFile('sampul')) {
            $path = $request->file('sampul')->store('sampul', 'public');
            $data['sampul'] = basename($path);
        }

        Buku::create($data);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    public function update(BukuRequest $request, Buku $buku) // atau Request $request
    {
        $data = $request->validated();

        if ($request->hasFile('sampul')) {
            if ($buku->sampul) {
                Storage::delete('public/sampul/' . $buku->sampul);
            }
            $path = $request->file('sampul')->store('sampul', 'public');
            $data['sampul'] = basename($path);
        }

        $buku->update($data);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Buku $buku)
    {
        if ($buku->sampul) {
            Storage::delete('public/sampul/' . $buku->sampul);
        }
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }
}