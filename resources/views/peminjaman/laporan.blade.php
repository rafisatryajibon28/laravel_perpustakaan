@extends('layouts.app')
@section('title', 'Laporan Peminjaman')
@section('page-title', 'Laporan Peminjaman Aktif')
@section('content')
    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card card-dashboard bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Buku</h6>
                            <h2 class="mb-0">{{ $totalBuku }}</h2>
                        </div>
                        <i class="bi bi-book" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-dashboard bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Anggota Aktif</h6>
                            <h2 class="mb-0">{{ $totalAnggotaAktif }}</h2>
                        </div>
                        <i class="bi bi-people" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-dashboard bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Sedang Dipinjam</h6>
                            <h2 class="mb-0">{{ $bukuDipinjam }}</h2>
                        </div>
                        <i class="bi bi-arrow-left-right" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-dashboard bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Terlambat</h6>
                            <h2 class="mb-0">{{ $bukuTerlambat }}</h2>
                        </div>
                        <i class="bi bi-exclamation-triangle" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Daftar Peminjaman Aktif -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">Daftar Peminjaman Aktif</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamanAktif as $index => $pinjam)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pinjam->anggota->nama_lengkap }}</td>
                                <td>{{ $pinjam->buku->judul }}</td>
                                <td>{{ $pinjam->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td>{{ $pinjam->tanggal_jatuh_tempo->format('d/m/Y') }}</td>
                                <td>
                                    @if ($pinjam->status == 'dipinjam')
                                        <span class="badge bg-warning">Dipinjam</span>
                                    @elseif($pinjam->status == 'terlambat')
                                        <span class="badge bg-danger">Terlambat</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($pinjam->status == 'terlambat')
                                        Rp {{ number_format($pinjam->hitungDenda(), 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('peminjaman.kembali', $pinjam->id) }}"
                                        class="btn btn-sm
btn-success">
                                        <i class="bi bi-arrow-return-left"></i> Proses Kembali
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada peminjaman aktif</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
