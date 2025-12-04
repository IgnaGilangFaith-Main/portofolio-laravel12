@extends('errors.layout')

@section('title', '404 - Halaman Tidak Ditemukan')
@section('code', '404')
@section('error-class', 'error-404')
@section('icon')
    <i class="bi bi-search"></i>
@endsection
@section('message')
    Ups! Halaman yang Anda cari tidak ditemukan. Mungkin sudah dipindahkan atau tidak pernah ada.
@endsection
