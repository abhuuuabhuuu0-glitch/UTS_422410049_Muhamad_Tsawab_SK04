@extends('layouts.app')
@section('title', 'Proyek Restorasi Baru')
@section('content')
<x-page-header title="Proyek Restorasi Baru" subtitle="Tugaskan pita ke teknisi dan tentukan peralatan." icon="bi-plus-circle" />
<form method="POST" action="{{ route('restorasi.store') }}" novalidate>
    @csrf
    @include('restorasi._form')
</form>
@endsection
