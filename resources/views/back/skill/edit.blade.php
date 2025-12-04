@extends('layouts.back')

@section('title', 'Edit Skill')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/about') }}">Tentang Saya</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/skill') }}">Skills</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Edit Skill
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/skill/' . $skill->id . '/update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama Skill --}}
                        <div class="mb-4">
                            <label for="nama" class="form-label">Nama Skill <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama', $skill->nama) }}" placeholder="Contoh: Laravel">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Update
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
