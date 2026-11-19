@extends('layouts.app')
@section('title', 'Ubah Pita')
@section('content')
<x-page-header title="Ubah Data Pita" subtitle="{{ $pita->judul }}" icon="bi-pencil-square" />
<form method="POST" action="{{ route('pita.update', $pita) }}" novalidate>
    @csrf
    @method('PUT')
    @include('pita._form')
</form>
@endsection
