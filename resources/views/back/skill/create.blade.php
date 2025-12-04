@extends('layouts.back')

@section('title', 'Tambah Skill')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/about') }}">Tentang Saya</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/skill') }}">Skills</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Skill
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/skill/create') }}" method="POST">
                        @csrf

                        {{-- Nama Skill --}}
                        <div class="mb-4">
                            <label for="nama" class="form-label">Nama Skill <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}" placeholder="Contoh: Laravel">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Masukkan nama skill seperti: PHP, Laravel, MySQL, JavaScript,
                                dll.</small>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                            <a href="{{ url('/skill') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
