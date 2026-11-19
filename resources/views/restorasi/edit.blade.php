@extends('layouts.app')
@section('title', 'Ubah Proyek Restorasi')
@section('content')
<x-page-header title="Ubah Proyek Restorasi" subtitle="{{ $restorasi->pita->judul }}" icon="bi-pencil-square" />
<form method="POST" action="{{ route('restorasi.update', $restorasi) }}" novalidate>
    @csrf
    @method('PUT')
    @include('restorasi._form')
</form>
@endsection
