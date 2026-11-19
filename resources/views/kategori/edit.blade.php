@extends('layouts.app')
@section('title', 'Ubah Kategori')
@section('content')
<x-page-header title="Ubah Kategori" subtitle="{{ $kategori->nama }}" icon="bi-pencil-square" />
<div class="col-lg-7 px-0">
<form method="POST" action="{{ route('kategori.update', $kategori) }}">@csrf @method('PUT') @include('kategori._form')</form>
</div>
@endsection
