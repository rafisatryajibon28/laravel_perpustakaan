@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
    <h1>Daftar Peminjaman</h1>

    <a href="{{ route('peminjaman.create') }}" class="btn btn-success mb-3">Catat Peminjaman Baru</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Kembali</th>
                <th>Status</th>
                <th>Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjaman as $index => $pinjam)
                <tr>
                    <td>{{ $index + 1 + ($peminjaman->currentPage() - 1) * $peminjaman->perPage() }}</td>
                    <td>{{ $pinjam->anggota->nama_lengkap }}</td>
                    <td>{{ $pinjam->buku->judul }}</td>
                    <td>{{ $pinjam->tanggal_pinjam->format('d/m/Y') }}</td>
                    <td>{{ $pinjam->tanggal_jatuh_tempo->format('d/m/Y') }}</td>
                    <td>{{ $pinjam->tanggal_kembali ? $pinjam->tanggal_kembali->format('d/m/Y') : '-' }}</td>
                    <td>
                        @if($pinjam->status == 'dipinjam') <span class="badge bg-primary">Dipinjam</span>
                        @elseif($pinjam->status == 'terlambat') <span class="badge bg-danger">Terlambat</span>
                        @elseif($pinjam->status == 'dikembalikan') <span class="badge bg-success">Dikembalikan</span>
                        @endif
                    </td>
                    <td>Rp {{ number_format($pinjam->denda, 0, ',', '.') }}</td>
                    <td>
                        @if($pinjam->status != 'dikembalikan')
                            <a href="{{ route('peminjaman.kembali', $pinjam->id) }}" class="btn btn-sm btn-outline-success">Proses Kembali</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="9">Belum ada data peminjaman.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $peminjaman->links() }}
@endsection