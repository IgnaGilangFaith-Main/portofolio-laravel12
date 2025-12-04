@extends('errors.layout')

@section('title', '401 - Unauthorized')
@section('code', '401')
@section('error-class', 'error-401')
@section('icon')
    <i class="bi bi-shield-lock"></i>
@endsection
@section('message')
    Anda harus login terlebih dahulu untuk mengakses halaman ini.
@endsection
