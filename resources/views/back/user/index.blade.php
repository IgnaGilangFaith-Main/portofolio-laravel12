@extends('layouts.back')

@section('title', 'Pengaturan Akun')

@section('breadcrumb')
    <li class="breadcrumb-item active">Pengaturan Akun</li>
@endsection

@section('content')
    <div class="row">
        {{-- Profile Card --}}
        <div class="col-lg-4 mb-4">
            <div class="card stat-card">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center"
                            style="width: 120px; height: 120px;">
                            <span class="text-white fw-bold" style="font-size: 3rem;">
                                {{ strtoupper(substr($data->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                    <h4 class="fw-bold mb-1">{{ $data->name }}</h4>
                    <p class="text-muted mb-3">{{ $data->email }}</p>

                    @if ($data->email_verified_at)
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle me-1"></i> Email Terverifikasi
                        </span>
                    @else
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-exclamation-circle me-1"></i> Email Belum Terverifikasi
                        </span>
                    @endif

                    <hr class="my-4">

                    <div class="text-start">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Bergabung sejak</span>
                            <span class="fw-semibold">{{ $data->created_at->isoFormat('d MMM Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Terakhir diupdate</span>
                            <span class="fw-semibold">{{ $data->updated_at->isoFormat('d MMM Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Account Info Card --}}
        <div class="col-lg-8 mb-4">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-person-gear me-2"></i>Informasi Akun
                        </h5>
                        <a href="{{ url('/pengaturan-akun/' . $data->id . '/edit') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil me-1"></i> Edit Profil
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        {{-- Name --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted small mb-1">Nama Lengkap</label>
                            <p class="fw-semibold mb-0">{{ $data->name }}</p>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted small mb-1">Email</label>
                            <p class="fw-semibold mb-0">{{ $data->email }}</p>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted small mb-1">Status Verifikasi</label>
                            <p class="mb-0">
                                @if ($data->email_verified_at)
                                    <span class="text-success fw-semibold">
                                        <i class="bi bi-check-circle me-1"></i> Terverifikasi pada
                                        {{ $data->email_verified_at->isoFormat('d MMM Y, H:mm') }}
                                    </span>
                                @else
                                    <span class="text-warning fw-semibold">
                                        <i class="bi bi-exclamation-circle me-1"></i> Belum Terverifikasi
                                    </span>
                                @endif
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Security Tips --}}
            <div class="card stat-card mt-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0">
                        <i class="bi bi-shield-check me-2"></i>Tips Keamanan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="small text-muted mb-2">
                                <i class="bi bi-check2 text-success me-2"></i>
                                Gunakan password minimal 6 karakter
                            </p>
                            <p class="small text-muted mb-2">
                                <i class="bi bi-check2 text-success me-2"></i>
                                Kombinasikan huruf, angka, dan simbol
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="small text-muted mb-2">
                                <i class="bi bi-check2 text-success me-2"></i>
                                Jangan gunakan password yang sama di tempat lain
                            </p>
                            <p class="small text-muted mb-0">
                                <i class="bi bi-check2 text-success me-2"></i>
                                Ganti password secara berkala
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
