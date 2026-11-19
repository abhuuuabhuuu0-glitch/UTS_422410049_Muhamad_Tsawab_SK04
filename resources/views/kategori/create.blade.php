@extends('layouts.app')
@section('title', 'Kategori Baru')
@section('content')
<x-page-header title="Tambah Kategori" icon="bi-plus-circle" />
<div class="col-lg-7 px-0">
<form method="POST" action="{{ route('kategori.store') }}">@csrf @include('kategori._form')</form>
</div>
@endsection
