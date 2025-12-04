@extends('layouts.back')

@section('title', 'Tambah About')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/about') }}">Tentang Saya</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Data About
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/about/create') }}" method="POST">
                        @csrf

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" value="{{ old('judul', 'Who am I?') }}" placeholder="Contoh: Who am I?">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
                                placeholder="Tuliskan deskripsi tentang diri Anda...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pendidikan --}}
                        <div class="mb-3">
                            <label for="pendidikan" class="form-label">Pendidikan</label>
                            <input type="text" class="form-control @error('pendidikan') is-invalid @enderror"
                                id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}"
                                placeholder="Contoh: Graduate - Piksi Ganesha Indonesia Polytechnic">
                            @error('pendidikan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- GPA --}}
                        <div class="mb-3">
                            <label for="gpa" class="form-label">GPA</label>
                            <input type="text" class="form-control @error('gpa') is-invalid @enderror" id="gpa"
                                name="gpa" value="{{ old('gpa') }}" placeholder="Contoh: 3.71">
                            @error('gpa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div class="mb-4">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi"
                                name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Indonesia">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                            <a href="{{ url('/about') }}" class="btn btn-secondary">
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
                        <i class="bi bi-dot"></i> Field bertanda <span class="text-danger">*</span> wajib diisi.
                    </p>
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> <strong>Judul</strong> adalah heading section (contoh: "Who am I?").
                    </p>
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> <strong>Deskripsi</strong> berisi penjelasan tentang diri Anda.
                    </p>
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> <strong>Pendidikan</strong> untuk info institusi pendidikan.
                    </p>
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> <strong>GPA</strong> untuk nilai IPK/GPA.
                    </p>
                    <p class="small text-muted mb-0">
                        <i class="bi bi-dot"></i> <strong>Lokasi</strong> untuk lokasi Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
