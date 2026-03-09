@extends('layouts.app')
@section('title', 'Tambah Buku')
@section('page-title', 'Tambah Buku Baru')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/formdata">
                        @csrf

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku <span class="textdanger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="penulis" class="form-label">Penulis <span class="textdanger">*</span></label>
                                <input type="text" class="form-control @error('penulis') is-invalid @enderror"
                                    id="penulis" name="penulis" value="{{ old('penulis') }}" required>
                                @error('penulis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="penerbit" class="form-label">Penerbit <span class="textdanger">*</span></label>
                                <input type="text" class="form-control @error('penerbit') is-invalid @enderror"
                                    id="penerbit" name="penerbit" value="{{ old('penerbit') }}" required>
                                @error('penerbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="tahun_terbit" class="form-label">Tahun Terbit <span
                                        class="textdanger">*</span></label>
                                <input type="number" class="form-control @error('tahun_terbit') is-invalid
@enderror"
                                    id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', date('Y')) }}"
                                    min="1900" max="{{ date('Y') }}" required>
                                @error('tahun_terbit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="isbn" class="form-label">ISBN <span class="textdanger">*</span></label>
                                <input type="text" class="form-control @error('isbn') is-invalid @enderror"
                                    id="isbn" name="isbn" value="{{ old('isbn') }}" required>
                                @error('isbn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="jumlah_halaman" class="form-label">Jumlah Halaman <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('jumlah_halaman') is-invalid
@enderror"
                                    id="jumlah_halaman" name="jumlah_halaman" value="{{ old('jumlah_halaman') }}"
                                    min="1" required>
                                @error('jumlah_halaman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori <span class="textdanger">*</span></label>
                                <select class="form-select @error('kategori') is-invalid @enderror" id="kategori"
                                    name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Novel" {{ old('kategori') == 'Novel' ? 'selected' : '' }}>Novel
                                    </option>
                                    <option value="Komik" {{ old('kategori') == 'Komik' ? 'selected' : '' }}>Komik
                                    </option>
                                    <option value="Pelajaran" {{ old('kategori') == 'Pelajaran' ? 'selected' : '' }}>
                                        Pelajaran</option>
                                    <option value="Ilmiah" {{ old('kategori') == 'Ilmiah' ? 'selected' : '' }}>Ilmiah
                                    </option>
                                    <option value="Biografi" {{ old('kategori') == 'Biografi' ? 'selected' : '' }}>Biografi
                                    </option>
                                    <option value="Sejarah" {{ old('kategori') == 'Sejarah' ? 'selected' : '' }}>Sejarah
                                    </option>
                                    <option value="Agama" {{ old('kategori') == 'Agama' ? 'selected' : '' }}>Agama
                                    </option>
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="stok" class="form-label">Stok <span class="textdanger">*</span></label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                    id="stok" name="stok" value="{{ old('stok', 1) }}" min="0" required>
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="sinopsis" class="form-label">Sinopsis</label>
                            <textarea class="form-control @error('sinopsis') is-invalid @enderror" id="sinopsis" name="sinopsis"
                                rows="5">{{ old('sinopsis') }}</textarea>
                            @error('sinopsis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sampul" class="form-label">Sampul Buku</label>
                            <input type="file" class="form-control @error('sampul') is-invalid @enderror"
                                id="sampul" name="sampul" accept="image/*">
                            <small class="text-muted">Format: JPG, JPEG, PNG. Maks: 2MB</small>
                            @error('sampul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <!-- Preview Gambar -->
                            <div class="mt-2" id="preview" style="display: none;">
                                <img id="preview-image" src="#" alt="Preview" style="max-height: 200px;">
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('buku.index') }}" class="btn btn-secondary me-md-2">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            // Preview gambar sebelum upload
            document.getElementById('sampul').onchange = function(evt) {
                var preview = document.getElementById('preview');
                var previewImage = document.getElementById('preview-image');
                var file = evt.target.files[0];

                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.style.display = 'none';
                }
            };
        </script>
    @endpush
@endsection
