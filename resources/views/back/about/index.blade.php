@extends('layouts.back')

@section('title', 'Tentang Saya')

@section('breadcrumb')
    <li class="breadcrumb-item active">Tentang Saya</li>
@endsection

@section('content')
    <div class="row">
        {{-- About Section --}}
        <div class="col-lg-7 mb-4">
            <div class="card stat-card h-100">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-person-vcard me-2"></i>Data About Me
                        </h5>
                        @if (!$about)
                            <a href="{{ url('/about/create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Data
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if (!$about)
                        {{-- Empty State --}}
                        <div class="text-center py-5">
                            <i class="bi bi-person-vcard text-muted" style="font-size: 4rem;"></i>
                            <h5 class="mt-3 text-muted">Belum ada data about</h5>
                            <p class="text-muted">Silakan tambahkan data about untuk ditampilkan.</p>
                            <a href="{{ url('/about/create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i> Tambah Data
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th width="120" class="text-muted">Judul</th>
                                        <td width="10">:</td>
                                        <td class="fw-semibold">{{ $about->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted align-top">Deskripsi</th>
                                        <td class="align-top">:</td>
                                        <td>{{ $about->deskripsi }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Pendidikan</th>
                                        <td>:</td>
                                        <td>{{ $about->pendidikan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">GPA</th>
                                        <td>:</td>
                                        <td>{{ $about->gpa ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Lokasi</th>
                                        <td>:</td>
                                        <td>{{ $about->lokasi ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Terakhir Update</th>
                                        <td>:</td>
                                        <td>{{ $about->updated_at->isoFormat('D MMM Y, H:mm') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 d-flex gap-2">
                            <a href="{{ url('/about/' . $about->id . '/edit') }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                            <a href="{{ url('/about/' . $about->id . '/delete') }}" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Skills Section --}}
        <div class="col-lg-5 mb-4">
            <div class="card stat-card h-100">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-tools me-2"></i>Skills
                        </h5>
                        <a href="{{ url('/skill/create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-circle me-1"></i> Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($skills->isEmpty())
                        <div class="text-center py-4">
                            <i class="bi bi-tools text-muted" style="font-size: 3rem;"></i>
                            <p class="mt-2 text-muted mb-0">Belum ada skill</p>
                        </div>
                    @else
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($skills as $skill)
                                <div
                                    class="badge bg-primary bg-opacity-10 text-primary border border-primary px-3 py-2 d-flex align-items-center gap-2">
                                    <span>{{ $skill->nama }}</span>
                                    <a href="{{ url('/skill/' . $skill->id . '/edit') }}" class="text-warning"
                                        title="Edit">
                                        <i class="bi bi-pencil-fill small"></i>
                                    </a>
                                    <a href="{{ url('/skill/' . $skill->id . '/delete') }}" class="text-danger"
                                        title="Hapus">
                                        <i class="bi bi-trash-fill small"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Info Card --}}
    <div class="card stat-card">
        <div class="card-header bg-white py-3">
            <h6 class="mb-0">
                <i class="bi bi-info-circle me-2"></i>Informasi
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> About Me menampilkan informasi tentang diri Anda.
                    </p>
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> Sebaiknya hanya ada <strong>satu data about</strong> yang aktif.
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="small text-muted mb-2">
                        <i class="bi bi-dot"></i> Skills menampilkan keahlian yang Anda miliki.
                    </p>
                    <p class="small text-muted mb-0">
                        <i class="bi bi-dot"></i> Tambahkan skill sesuai keahlian Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
