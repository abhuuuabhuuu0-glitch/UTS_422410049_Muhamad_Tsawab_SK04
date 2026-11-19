@extends('layouts.app')
@section('title', 'Tambah Pita')
@section('content')
<x-page-header title="Tambah Pita Baru" subtitle="Daftarkan pita analog ke dalam arsip." icon="bi-plus-circle" />
<form method="POST" action="{{ route('pita.store') }}" novalidate>
    @csrf
    @include('pita._form')
</form>
@endsection
