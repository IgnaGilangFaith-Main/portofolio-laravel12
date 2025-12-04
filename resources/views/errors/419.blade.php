@extends('errors.layout')

@section('title', '419 - Page Expired')
@section('code', '419')
@section('error-class', 'error-419')
@section('icon')
    <i class="bi bi-clock-history"></i>
@endsection
@section('message')
    Sesi Anda telah berakhir. Silakan refresh halaman dan coba lagi.
@endsection
