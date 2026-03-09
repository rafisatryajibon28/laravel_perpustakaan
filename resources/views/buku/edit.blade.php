@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <h1 class="mb-4">Edit Buku: {{ $buku->judul }}</h1>

    <form method="POST" action="{{ route('buku.update', $buku) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                           value="{{ old('judul', $buku->judul) }}" required>
                    @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Penulis <span class="text-danger">*</span></label>
                    <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror" 
                           value="{{ old('penulis', $buku->penulis) }}" required>
                    @error('penulis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Penerbit <span class="text-danger">*</span></label>
                    <input type="text" name="penerbit" class="form-control @error('penerbit') is-invalid @enderror" 
                           value="{{ old('penerbit', $buku->penerbit) }}" required>
                    @error('penerbit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                            <input type="number" name="tahun_terbit" class="form-control @error('tahun_terbit') is-invalid @enderror" 
                                   value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" min="1900" max="{{ date('Y') }}" required>
                            @error('tahun_terbit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Halaman <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_halaman" class="form-control @error('jumlah_halaman') is-invalid @enderror" 
                                   value="{{ old('jumlah_halaman', $buku->jumlah_halaman) }}" min="1" required>
                            @error('jumlah_halaman') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">ISBN <span class="text-danger">*</span></label>
                    <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror" 
                           value="{{ old('isbn', $buku->isbn) }}" required>
                    @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Novel" {{ old('kategori', $buku->kategori) == 'Novel' ? 'selected' : '' }}>Novel</option>
                        <option value="Komik" {{ old('kategori', $buku->kategori) == 'Komik' ? 'selected' : '' }}>Komik</option>
                        <option value="Pelajaran" {{ old('kategori', $buku->kategori) == 'Pelajaran' ? 'selected' : '' }}>Pelajaran</option>
                        <option value="Ilmiah" {{ old('kategori', $buku->kategori) == 'Ilmiah' ? 'selected' : '' }}>Ilmiah</option>
                        <option value="Biografi" {{ old('kategori', $buku->kategori) == 'Biografi' ? 'selected' : '' }}>Biografi</option>
                        <option value="Sejarah" {{ old('kategori', $buku->kategori) == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                        <option value="Agama" {{ old('kategori', $buku->kategori) == 'Agama' ? 'selected' : '' }}>Agama</option>
                    </select>
                    @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" 
                           value="{{ old('stok', $buku->stok) }}" min="0" required>
                    @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Sinopsis</label>
                    <textarea name="sinopsis" class="form-control @error('sinopsis') is-invalid @enderror" rows="4">{{ old('sinopsis', $buku->sinopsis) }}</textarea>
                    @error('sinopsis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Sampul Saat Ini</label><br>
                    @if($buku->sampul)
                        <img src="{{ asset('storage/sampul/' . $buku->sampul) }}" alt="Sampul Saat Ini" style="max-width:200px; border-radius:8px;">
                    @else
                        <p class="text-muted">Tidak ada sampul</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti Sampul (opsional)</label>
                    <input type="file" name="sampul" class="form-control @error('sampul') is-invalid @enderror" accept="image/*">
                    @error('sampul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maks: 2MB</small>
                </div>

                <div id="preview" class="mt-3 text-center" style="display:none;">
                    <img id="preview-img" src="#" alt="Preview Sampul Baru" style="max-width:100%; max-height:300px; border-radius:8px;">
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update Buku</button>
        </div>
    </form>

    @push('scripts')
    <script>
        document.querySelector('input[name="sampul"]').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            const previewImg = document.getElementById('preview-img');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
    @endpush
@endsection