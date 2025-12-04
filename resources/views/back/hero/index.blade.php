@extends('layouts.back')

@section('title', 'Hero')

@section('breadcrumb')
    <li class="breadcrumb-item active">Hero</li>
@endsection

@section('content')
    <div class="card stat-card">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-person-vcard me-2"></i>Data Hero Section
                </h5>
                @if ($heroes->isEmpty())
                    <a href="{{ url('/hero/create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Data
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if ($heroes->isEmpty())
                {{-- Empty State --}}
                <div class="text-center py-5">
                    <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                    <h5 class="mt-3 text-muted">Belum ada data hero</h5>
                    <p class="text-muted">Silakan tambahkan data hero untuk ditampilkan di halaman utama.</p>
                    <a href="{{ url('/hero/create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Data Hero
                    </a>
                </div>
            @else
                {{-- Hero Data --}}
                @foreach ($heroes as $hero)
                    <div class="row align-items-center">
                        <div class="col-lg-3 text-center mb-4 mb-lg-0">
                            <img src="{{ asset('img/hero/' . $hero->foto) }}" alt="{{ $hero->nama }}"
                                class="img-fluid rounded shadow" style="max-height: 200px; object-fit: cover;">
                        </div>
                        <div class="col-lg-9">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th width="120" class="text-muted">Nama</th>
                                            <td width="10">:</td>
                                            <td class="fw-semibold">{{ $hero->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Moto</th>
                                            <td>:</td>
                                            <td>{{ $hero->moto }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted align-top">Deskripsi</th>
                                            <td class="align-top">:</td>
                                            <td>{{ $hero->deskripsi }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted">Terakhir Update</th>
                                            <td>:</td>
                                            <td>{{ $hero->updated_at->isoFormat('D MMM Y, H:mm') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3 d-flex gap-2">
                                <a href="{{ url('/hero/' . $hero->id . '/edit') }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </a>
                                <a href="{{ url('/hero/' . $hero->id . '/delete') }}" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </a>
                            </div>
                        </div>
                    </div>

                    @if (!$loop->last)
                        <hr class="my-4">
                    @endif
                @endforeach
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
                        <i class="bi bi-dot"></i> Hero section adalah bagian pertama yang dilihat pengunjung di halaman
                        utama.
                    </p>
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> Sebaiknya hanya ada <strong>satu data hero</strong> yang aktif.
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> Pastikan foto yang digunakan memiliki kualitas yang baik.
                    </p>
                    <p class="small text-muted mb-0">
                        <i class="bi bi-dot"></i> Deskripsi sebaiknya singkat dan menarik.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
