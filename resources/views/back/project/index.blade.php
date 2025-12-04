@extends('layouts.back')

@section('title', 'Proyek')

@section('breadcrumb')
    <li class="breadcrumb-item active">Proyek</li>
@endsection

@section('content')
    <div class="card stat-card">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-briefcase me-2"></i>Daftar Proyek
                </h5>
                <a href="{{ url('/project/create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Proyek
                </a>
            </div>
        </div>
        <div class="card-body">
            @if ($projects->isEmpty())
                {{-- Empty State --}}
                <div class="text-center py-5">
                    <i class="bi bi-briefcase text-muted" style="font-size: 4rem;"></i>
                    <h5 class="mt-3 text-muted">Belum ada proyek</h5>
                    <p class="text-muted">Silakan tambahkan proyek yang sudah Anda kerjakan.</p>
                    <a href="{{ url('/project/create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Proyek
                    </a>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($projects as $project)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border">
                                <img src="{{ asset('img/project/' . $project->foto) }}" class="card-img-top"
                                    alt="{{ $project->judul_proyek }}" style="height: 180px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="card-title fw-semibold">{{ $project->judul_proyek }}</h6>
                                    <p class="card-text text-muted small">
                                        {{ Str::limit($project->deskripsi_proyek, 100) }}
                                    </p>
                                    @if ($project->link)
                                        <a href="{{ $project->link }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-link-45deg me-1"></i> Lihat Proyek
                                        </a>
                                    @endif
                                </div>
                                <div class="card-footer bg-white border-top-0">
                                    <div class="d-flex gap-2">
                                        <a href="{{ url('/project/' . $project->id . '/edit') }}"
                                            class="btn btn-warning btn-sm flex-fill">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </a>
                                        <a href="{{ url('/project/' . $project->id . '/delete') }}"
                                            class="btn btn-danger btn-sm flex-fill">
                                            <i class="bi bi-trash me-1"></i> Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Info Card --}}
    <div class="card stat-card mt-4">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0">
                <i class="bi bi-info-circle me-2"></i>Informasi
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> Proyek akan ditampilkan di section Projects pada halaman utama.
                    </p>
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> Gunakan foto dengan kualitas baik untuk tampilan yang menarik.
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> Deskripsi singkat dan jelas akan lebih menarik.
                    </p>
                    <p class="small text-muted mb-0">
                        <i class="bi bi-dot"></i> Proyek terbaru akan ditampilkan lebih dulu.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
