@extends('layouts.back')

@section('title', 'Hapus Hero')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/hero') }}">Hero</a></li>
    <li class="breadcrumb-item active">Hapus</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus Data
                    </h5>
                </div>
                <div class="card-body">
                    {{-- Preview Data --}}
                    <div class="text-center mb-4">
                        <img src="{{ asset('img/hero/' . $hero->foto) }}" alt="{{ $hero->nama }}"
                            class="img-fluid rounded shadow mb-3" style="max-height: 150px; object-fit: cover;">
                        <h5 class="mb-1">{{ $hero->nama }}</h5>
                        <p class="text-muted small mb-0">{{ $hero->moto }}</p>
                    </div>

                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div>
                            Apakah Anda yakin ingin menghapus data hero ini? Data yang sudah dihapus tidak dapat
                            dikembalikan.
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <a href="{{ url('/hero') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <form action="{{ url('/hero/' . $hero->id . '/delete') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Ya, Hapus Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
