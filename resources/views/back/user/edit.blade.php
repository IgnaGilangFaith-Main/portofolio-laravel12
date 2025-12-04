@extends('layouts.back')

@section('title', 'Edit Profil')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/pengaturan-akun') }}" class="text-decoration-none">Pengaturan Akun</a></li>
    <li class="breadcrumb-item active">Edit Profil</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card stat-card">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil me-2"></i>Edit Profil
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/pengaturan-akun/' . $user->id . '/update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Informasi Dasar --}}
                        <h6 class="fw-bold mb-3 text-primary">
                            <i class="bi bi-person me-2"></i>Informasi Dasar
                        </h6>

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama lengkap"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan email"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        {{-- Ubah Password --}}
                        <h6 class="fw-bold mb-3 text-primary">
                            <i class="bi bi-key me-2"></i>Ubah Password
                            <span class="text-muted fw-normal small">(Opsional)</span>
                        </h6>

                        <div class="alert alert-info mb-3">
                            <i class="bi bi-info-circle me-2"></i>
                            <small>Kosongkan jika tidak ingin mengubah password.</small>
                        </div>

                        {{-- New Password --}}
                        <div class="mb-3">
                            <label for="new_password" class="form-label fw-semibold">
                                Password Baru
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="new_password" name="new_password" placeholder="Masukkan password baru">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('new_password')">
                                    <i class="bi bi-eye" id="new_password_icon"></i>
                                </button>
                            </div>
                            @error('new_password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimal 6 karakter</small>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label fw-semibold">
                                Konfirmasi Password Baru
                            </label>
                            <div class="input-group">
                                <input type="password"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                    id="new_password_confirmation" name="new_password_confirmation"
                                    placeholder="Ulangi password baru">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('new_password_confirmation')">
                                    <i class="bi bi-eye" id="new_password_confirmation_icon"></i>
                                </button>
                            </div>
                            @error('new_password_confirmation')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ url('/pengaturan-akun') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '_icon');

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
@endpush
