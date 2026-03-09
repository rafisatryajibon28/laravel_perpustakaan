@extends('layouts.app')
@section('title', $buku->judul)
@section('page-title', 'Detail Buku')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                @if ($buku->sampul)
                    <img src="{{ asset('storage/sampul/' . $buku->sampul) }}" class="card-img-top" alt="{{ $buku->judul }}">
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                        style="height: 300px;">
                        <i class="bi bi-book" style="font-size: 5rem;"></i>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $buku->judul }}</h3>
                    <hr>

                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Penulis</th>
                            <td>: {{ $buku->penulis }}</td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <td>: {{ $buku->penerbit }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Terbit</th>
                            <td>: {{ $buku->tahun_terbit }}</td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td>: {{ $buku->isbn }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Halaman</th>
                            <td>: {{ $buku->jumlah_halaman }} halaman</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>: <span class="badge bg-info">{{ $buku->kategori }}</span></td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>: {!! $buku->status_stok !!} ({{ $buku->stok }} tersedia)</td>
                        </tr>
                    </table>
                    <div class="mt-3">
                        <h5>Sinopsis:</h5>
                        <p class="text-justify">{{ $buku->sinopsis ?? 'Tidak ada sinopsis' }}</p>
                    </div>
                    @if ($buku->stok > 0)
                        <a href="{{ route('peminjaman.create') }}?buku={{ $buku->id }}" class="btn btnprimary mt-3">
                            <i class="bi bi-bookmark-plus"></i> Pinjam Buku
                        </a>
                    @endif

                    <a href="{{ route('buku.index') }}" class="btn btn-secondary mt-3">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection