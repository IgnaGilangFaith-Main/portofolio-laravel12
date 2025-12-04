@extends('errors.layout')

@section('title', '405 - Method Not Allowed')
@section('code', '405')
@section('error-class', 'error-405')
@section('icon')
    <i class="bi bi-x-octagon"></i>
@endsection
@section('message')
    Metode permintaan tidak diizinkan untuk halaman ini. Silakan gunakan metode yang benar.
@endsection
