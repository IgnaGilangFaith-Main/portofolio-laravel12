@extends('errors.layout')

@section('title', '400 - Bad Request')
@section('code', '400')
@section('error-class', 'error-400')
@section('icon')
    <i class="bi bi-exclamation-circle"></i>
@endsection
@section('message')
    Permintaan tidak valid. Server tidak dapat memproses permintaan karena kesalahan klien.
@endsection
