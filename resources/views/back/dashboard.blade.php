@extends('layouts.back')

@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row g-4">
        <div class="col-sm-6 col-xl-4">
            <a href="{{ url('/hero') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-opacity-10 ">
                                <i class="bi bi-person-vcard"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Bagian Hero</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-xl-4">
            <a href="{{ url(path: '/about') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-opacity-10 ">
                                <i class="bi bi-person-vcard"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Tentang Saya</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-sm-6 col-xl-4">
            <a href="{{ url('/project') }}" class="text-decoration-none">
                <div class="card stat-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-opacity-10 ">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Proyek</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
