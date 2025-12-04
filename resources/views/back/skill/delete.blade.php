@extends('layouts.back')

@section('title', 'Hapus Skill')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/about') }}">Tentang Saya</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/skill') }}">Skills</a></li>
    <li class="breadcrumb-item active">Hapus</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                </div>
                <div class="card-body text-center">
                    {{-- Preview Data --}}
                    <div class="mb-4">
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-4 py-3 fs-5">
                            {{ $skill->nama }}
                        </span>
                    </div>

                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Apakah Anda yakin ingin menghapus skill ini?
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <a href="{{ url('/skill') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <form action="{{ url('/skill/' . $skill->id . '/delete') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
