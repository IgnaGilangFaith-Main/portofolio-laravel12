@extends('layouts.back')

@section('title', 'Tambah Hero')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/hero') }}">Hero</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Data Hero
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/hero/create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Moto --}}
                        <div class="mb-3">
                            <label for="moto" class="form-label">Moto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('moto') is-invalid @enderror" id="moto"
                                name="moto" value="{{ old('moto') }}"
                                placeholder="Contoh: Fullstack Developer | PHP | Laravel">
                            @error('moto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
                                placeholder="Tuliskan deskripsi singkat tentang diri Anda...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Foto --}}
                        <div class="mb-4">
                            <label for="foto" class="form-label">Foto <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/jpeg,image/png,image/jpg,image/webp"
                                onchange="previewImage(event)">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPEG, PNG, JPG, WEBP. Maksimal 2MB.</small>

                            {{-- Preview Image --}}
                            <div class="mt-3" id="imagePreviewContainer" style="display: none;">
                                <label class="form-label">Preview:</label>
                                <div class="border rounded p-2 d-inline-block">
                                    <img id="imagePreview" src="" alt="Preview" class="img-fluid rounded"
                                        style="max-height: 200px;">
                                </div>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                            <a href="{{ url('/hero') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Info Card --}}
        <div class="col-lg-4">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>Informasi
                    </h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> Semua field bertanda <span class="text-danger">*</span> wajib diisi.
                    </p>
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> <strong>Nama</strong> akan ditampilkan sebagai judul utama di hero
                        section.
                    </p>
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> <strong>Moto</strong> adalah tagline atau subtitle yang mendeskripsikan
                        keahlian Anda.
                    </p>
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> <strong>Deskripsi</strong> berisi penjelasan singkat tentang diri Anda.
                    </p>
                    <p class="small text-muted mb-0">
                        <i class="bi bi-dot"></i> <strong>Foto</strong> sebaiknya menggunakan foto dengan rasio 1:1
                        (square).
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const container = document.getElementById('imagePreviewContainer');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                container.style.display = 'none';
            }
        }
    </script>
@endpush
