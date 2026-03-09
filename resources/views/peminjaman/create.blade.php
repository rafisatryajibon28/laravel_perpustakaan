@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('content')
    <h1>Form Peminjaman Buku</h1>

    <form method="POST" action="{{ route('peminjaman.store') }}">
        @csrf

        <div class="mb-3">
            <label>Buku</label>
            <select name="id_buku" class="form-select" required>
                <option value="">Pilih Buku</option>
                @foreach($buku as $b)
                    <option value="{{ $b->id }}">{{ $b->judul }} (Stok: {{ $b->stok }})</option>
                @endforeach
            </select>
            @error('id_buku') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Anggota</label>
            <select name="id_anggota" class="form-select" required>
                <option value="">Pilih Anggota</option>
                @foreach($anggota as $a)
                    <option value="{{ $a->id }}">{{ $a->nama_lengkap }} - {{ $a->nis }}</option>
                @endforeach
            </select>
            @error('id_anggota') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label>Jatuh Tempo</label>
            <input type="date" name="tanggal_jatuh_tempo" class="form-control" value="{{ now()->addDays(7)->format('Y-m-d') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
    </form>
@endsection