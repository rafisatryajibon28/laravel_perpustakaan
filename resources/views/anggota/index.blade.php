@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
    <h1>Data Anggota Perpustakaan</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama Lengkap</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anggota as $a)
                <tr>
                    <td>{{ $a->nis }}</td>
                    <td>{{ $a->nama_lengkap }}</td>
                    <td>{{ $a->kelas }}</td>
                    <td>{{ $a->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>
                        @if($a->status_aktif)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td>{{ $a->tanggal_daftar_formatted }}</td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada data anggota.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $anggota->links() }}
@endsection