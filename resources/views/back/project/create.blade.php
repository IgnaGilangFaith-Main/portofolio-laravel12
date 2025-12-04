@extends('layouts.back')

@section('title', 'Tambah Proyek')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/project') }}" class="text-decoration-none">Proyek</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Proyek Baru
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/project/create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Judul Proyek --}}
                        <div class="mb-3">
                            <label for="judul_proyek" class="form-label fw-semibold">
                                Judul Proyek <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('judul_proyek') is-invalid @enderror"
                                id="judul_proyek" name="judul_proyek" value="{{ old('judul_proyek') }}"
                                placeholder="Contoh: E-Commerce Website" required>
                            @error('judul_proyek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi Proyek --}}
                        <div class="mb-3">
                            <label for="deskripsi_proyek" class="form-label fw-semibold">
                                Deskripsi <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('deskripsi_proyek') is-invalid @enderror" id="deskripsi_proyek"
                                name="deskripsi_proyek" rows="4" placeholder="Jelaskan tentang proyek ini..." required>{{ old('deskripsi_proyek') }}</textarea>
                            @error('deskripsi_proyek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Jelaskan tentang proyek, teknologi yang digunakan, fitur utama,
                                dll.</small>
                        </div>

                        {{-- Foto --}}
                        <div class="mb-3">
                            <label for="foto" class="form-label fw-semibold">
                                Foto Proyek <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/*" required onchange="previewImage(event)">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, JPEG, PNG, WebP. Maksimal: 2MB. Rasio 16:9
                                disarankan.</small>

                            {{-- Preview --}}
                            <div id="imagePreview" class="mt-3 d-none">
                                <label class="form-label text-muted small">Preview:</label>
                                <div class="rounded overflow-hidden border" style="max-width: 400px;">
                                    <img id="preview" src="" alt="Preview" class="img-fluid">
                                </div>
                            </div>
                        </div>

                        {{-- Link Proyek --}}
                        <div class="mb-4">
                            <label for="link" class="form-label fw-semibold">
                                Link Proyek <span class="text-muted fw-normal">(opsional)</span>
                            </label>
                            <input type="url" class="form-control @error('link') is-invalid @enderror" id="link"
                                name="link" value="{{ old('link') }}" placeholder="https://example.com">
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Link demo atau repository proyek (GitHub, GitLab, dll).</small>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Simpan
                            </button>
                            <a href="{{ url('/project') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tips --}}
            <div class="card stat-card mt-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0">
                        <i class="bi bi-lightbulb me-2"></i>Tips
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="small text-muted mb-0">
                        <li>Gunakan judul yang singkat dan deskriptif.</li>
                        <li>Jelaskan teknologi, fitur, dan peran Anda dalam proyek.</li>
                        <li>Gunakan screenshot atau mockup dengan kualitas baik.</li>
                        <li>Foto dengan rasio 16:9 akan tampil lebih baik.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                preview.src = URL.createObjectURL(file);
                previewContainer.classList.remove('d-none');
            } else {
                previewContainer.classList.add('d-none');
            }
        }
    </script>
@endpush
