@extends('layouts.app')

@section('title', 'Dashboard MyDigitalLibrary')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Selamat Datang di MyDigitalLibrary</h1>
        <p class="lead text-center mb-5">Sistem Manajemen Perpustakaan Digital Sekolah</p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-primary h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-book fs-1 text-primary mb-3 d-block"></i>
                        <h5 class="card-title">Total Buku</h5>
                        <h2 class="display-5 fw-bold">{{ $totalBuku ?? Buku::count() }}</h2>
                        <p class="text-muted">Koleksi buku tersedia di perpustakaan</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-success h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-people fs-1 text-success mb-3 d-block"></i>
                        <h5 class="card-title">Anggota Aktif</h5>
                        <h2 class="display-5 fw-bold">{{ $totalAnggotaAktif ?? Anggota::aktif()->count() }}</h2>
                        <p class="text-muted">Siswa yang terdaftar dan aktif</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-warning h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-bookmark fs-1 text-warning mb-3 d-block"></i>
                        <h5 class="card-title">Sedang Dipinjam</h5>
                        <h2 class="display-5 fw-bold">{{ $bukuDipinjam ?? Peminjaman::whereIn('status', ['dipinjam', 'terlambat'])->count() }}</h2>
                        <p class="text-muted">Buku yang sedang dipinjam siswa</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Ringkasan Peminjaman Terbaru</h5>
                    </div>
                    <div class="card-body">
                        @if($peminjamanTerbaru ?? Peminjaman::with(['buku', 'anggota'])->latest()->take(5)->get()->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Anggota</th>
                                            <th>Buku</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($peminjamanTerbaru ?? Peminjaman::with(['buku', 'anggota'])->latest()->take(5)->get() as $index => $pinjam)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $pinjam->anggota->nama_lengkap }}</td>
                                                <td>{{ $pinjam->buku->judul }}</td>
                                                <td>{{ $pinjam->tanggal_pinjam->format('d/m/Y') }}</td>
                                                <td>
                                                    @if($pinjam->status == 'dipinjam')
                                                        <span class="badge bg-primary">Dipinjam</span>
                                                    @elseif($pinjam->status == 'terlambat')
                                                        <span class="badge bg-danger">Terlambat</span>
                                                    @else
                                                        <span class="badge bg-success">Dikembalikan</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center text-muted py-4">Belum ada aktivitas peminjaman.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <h5 class="mb-4">Aksi Cepat</h5>
                <a href="{{ route('buku.create') }}" class="btn btn-lg btn-primary me-3">Tambah Buku Baru</a>
                <a href="{{ route('peminjaman.create') }}" class="btn btn-lg btn-success me-3">Catat Peminjaman</a>
                <a href="{{ route('peminjaman.laporan') }}" class="btn btn-lg btn-info">Lihat Laporan Lengkap</a>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @endpush
@endsection