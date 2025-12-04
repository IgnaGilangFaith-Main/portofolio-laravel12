@extends('layouts.back')

@section('title', 'Hapus Proyek')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/project') }}" class="text-decoration-none">Proyek</a></li>
    <li class="breadcrumb-item active">Hapus</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card stat-card border-danger">
                <div class="card-header bg-danger text-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                </div>
                <div class="card-body text-center py-4">
                    {{-- Project Preview --}}
                    <div class="mb-4">
                        <div class="rounded overflow-hidden border mx-auto" style="max-width: 300px;">
                            <img src="{{ asset('img/project/' . $project->foto) }}" alt="{{ $project->judul_proyek }}"
                                class="img-fluid">
                        </div>
                    </div>

                    <div class="mb-4">
                        <i class="bi bi-trash text-danger" style="font-size: 3rem;"></i>
                    </div>

                    <h5 class="mb-3">Yakin ingin menghapus proyek ini?</h5>

                    <div class="bg-light rounded p-3 mb-4">
                        <p class="mb-1 fw-semibold">{{ $project->judul_proyek }}</p>
                        <p class="text-muted small mb-0">
                            {{ Str::limit($project->deskripsi_proyek, 100) }}
                        </p>
                    </div>

                    <div class="alert alert-warning mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        <small>Data yang sudah dihapus tidak dapat dikembalikan. Foto proyek juga akan dihapus.</small>
                    </div>

                    <div class="d-flex justify-content-center gap-2">
                        <form action="{{ url('/project/' . $project->id . '/delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i> Ya, Hapus
                            </button>
                        </form>
                        <a href="{{ url('/project') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
