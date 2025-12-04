@extends('layouts.back')

@section('title', 'Edit About')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/about') }}">Tentang Saya</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Edit Data About
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/about/' . $about->id . '/update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" value="{{ old('judul', $about->judul) }}" placeholder="Contoh: Who am I?">
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
                                placeholder="Tuliskan deskripsi tentang diri Anda...">{{ old('deskripsi', $about->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pendidikan --}}
                        <div class="mb-3">
                            <label for="pendidikan" class="form-label">Pendidikan</label>
                            <input type="text" class="form-control @error('pendidikan') is-invalid @enderror"
                                id="pendidikan" name="pendidikan" value="{{ old('pendidikan', $about->pendidikan) }}"
                                placeholder="Contoh: Graduate - Piksi Ganesha Indonesia Polytechnic">
                            @error('pendidikan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- GPA --}}
                        <div class="mb-3">
                            <label for="gpa" class="form-label">GPA</label>
                            <input type="text" class="form-control @error('gpa') is-invalid @enderror" id="gpa"
                                name="gpa" value="{{ old('gpa', $about->gpa) }}" placeholder="Contoh: 3.71">
                            @error('gpa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div class="mb-4">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi"
                                name="lokasi" value="{{ old('lokasi', $about->lokasi) }}" placeholder="Contoh: Indonesia">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Update
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
                        <i class="bi bi-dot"></i> <strong>Judul</strong> adalah heading section.
                    </p>
                    <p class="small text-muted mb-0">
                        <i class="bi bi-dot"></i> <strong>Deskripsi</strong> berisi penjelasan tentang diri Anda.
                    </p>
                </div>
            </div>

            {{-- Data Info --}}
            <div class="card stat-card mt-3">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>Info Data
                    </h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-2">
                        <i class="bi bi-calendar-plus me-1"></i> Dibuat:
                        {{ $about->created_at->isoFormat('D MMM Y, H:mm') }}
                    </p>
                    <p class="small text-muted mb-0">
                        <i class="bi bi-calendar-check me-1"></i> Diupdate:
                        {{ $about->updated_at->isoFormat('D MMM Y, H:mm') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
