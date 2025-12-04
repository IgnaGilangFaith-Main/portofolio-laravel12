@extends('errors.layout')

@section('title', '403 - Forbidden')
@section('code', '403')
@section('error-class', 'error-403')
@section('icon')
    <i class="bi bi-ban"></i>
@endsection
@section('message')
    Anda tidak memiliki izin untuk mengakses halaman ini. Hubungi administrator jika Anda merasa ini adalah kesalahan.
@endsection
