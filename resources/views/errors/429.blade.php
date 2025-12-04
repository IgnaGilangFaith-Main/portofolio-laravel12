@extends('errors.layout')

@section('title', '429 - Too Many Requests')
@section('code', '429')
@section('error-class', 'error-429')
@section('icon')
    <i class="bi bi-hourglass-split"></i>
@endsection
@section('message')
    Terlalu banyak permintaan. Silakan tunggu beberapa saat sebelum mencoba lagi.
@endsection
