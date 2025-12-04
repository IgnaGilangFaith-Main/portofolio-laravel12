@extends('errors.layout')

@section('title', '500 - Server Error')
@section('code', '500')
@section('error-class', 'error-500')
@section('icon')
    <i class="bi bi-gear-wide-connected"></i>
@endsection
@section('message')
    Terjadi kesalahan pada server. Tim kami sedang bekerja untuk memperbaikinya. Silakan coba lagi nanti.
@endsection
