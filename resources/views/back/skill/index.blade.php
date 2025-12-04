@extends('layouts.back')

@section('title', 'Skills')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/about') }}">Tentang Saya</a></li>
    <li class="breadcrumb-item active">Skills</li>
@endsection

@section('content')
    <div class="card stat-card">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-tools me-2"></i>Daftar Skills
                </h5>
                <a href="{{ url('/skill/create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Skill
                </a>
            </div>
        </div>
        <div class="card-body">
            @if ($skills->isEmpty())
                {{-- Empty State --}}
                <div class="text-center py-5">
                    <i class="bi bi-tools text-muted" style="font-size: 4rem;"></i>
                    <h5 class="mt-3 text-muted">Belum ada skill</h5>
                    <p class="text-muted">Silakan tambahkan skill yang Anda miliki.</p>
                    <a href="{{ url('/skill/create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Skill
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Skill</th>
                                <th>Ditambahkan</th>
                                <th width="150" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skills as $index => $skill)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary border border-primary px-3 py-2">
                                            {{ $skill->nama }}
                                        </span>
                                    </td>
                                    <td>{{ $skill->created_at->isoFormat('D MMM Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('/skill/' . $skill->id . '/edit') }}"
                                            class="btn btn-warning btn-sm me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ url('/skill/' . $skill->id . '/delete') }}"
                                            class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            <p class="small text-muted mb-2">
                <i class="bi bi-dot"></i> Skills akan ditampilkan di section About Me pada halaman utama.
            </p>
            <p class="small text-muted mb-0">
                <i class="bi bi-dot"></i> Urutan skill berdasarkan waktu ditambahkan (yang pertama ditambahkan akan tampil
                duluan).
            </p>
        </div>
    </div>
@endsection
