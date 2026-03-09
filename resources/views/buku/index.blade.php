@extends('layouts.app')
@section('title', 'Daftar Buku')
@section('page-title', 'Daftar Buku')
@section('content')
    <div class="row mb-4">
        <div class="col-md-6">
            <!-- Form Pencarian -->
            <form action="{{ route('buku.index') }}" method="GET" class="d-flex">
                <input type="text" name="cari" class="form-control me-2" placeholder="Cari judul atau
penulis..."
                    value="{{ request('cari') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Cari
                </button>
            </form>
        </div>
        <div class="col-md-4">
            <!-- Filter Kategori -->
            <select name="kategori" class="form-select"
                onchange="window.location.href = this.value
? '?kategori=' + this.value : '{{ route('buku.index') }}'">
                <option value="">Semua Kategori</option>
                @foreach ($kategoriList as $kategori)
                    <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                        {{ $kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 text-end">
            <a href="{{ route('buku.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Buku
            </a>
        </div>
    </div>
    <div class="row">
        @forelse($buku as $item)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <!-- Gambar Sampul -->
                    @if ($item->sampul)
                        <img src="{{ asset('storage/sampul/' . $item->sampul) }}" class="card-img-top"
                            alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                            style="height: 200px;">
                            <i class="bi bi-book" style="font-size: 4rem;"></i>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="bi bi-pencil"></i> {{ $item->penulis }}<br>
                                <i class="bi bi-building"></i> {{ $item->penerbit }}
                            </small>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-info">{{ $item->kategori }}</span>
                            {!! $item->status_stok !!}
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="btn-group w-100">
                            <a href="{{ route('buku.show', $item->id) }}" class="btn btn-sm btn-outlineprimary">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                            <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-sm btn-outlinewarning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger"
                                onclick="confirmDelete({{ $item->id }})">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Tidak ada data buku.
                </div>
            </div>
        @endforelse
    </div>
    <div class="row mt-4">
        <div class="col-12">
            {{ $buku->links() }}
        </div>
    </div>
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    @push('scripts')
        <script>
            function confirmDelete(id) {
                if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
                    var form = document.getElementById('delete-form');
                    form.action = '/buku/' + id;
                    form.submit();
                }
            }
        </script>
    @endpush
@endsection
