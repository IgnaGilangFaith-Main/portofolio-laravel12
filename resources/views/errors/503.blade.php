@extends('errors.layout')

@section('title', '503 - Service Unavailable')
@section('code', '503')
@section('error-class', 'error-503')
@section('icon')
    <i class="bi bi-tools"></i>
@endsection
@section('message')
    Layanan sedang dalam pemeliharaan. Kami akan segera kembali. Terima kasih atas kesabaran Anda.
@endsection
