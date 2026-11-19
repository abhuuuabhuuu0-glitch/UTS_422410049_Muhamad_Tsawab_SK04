@props(['kondisi'])
@php
    $map = ['baik' => 'success', 'sedang' => 'warning', 'rusak_berat' => 'danger'];
    $label = \App\Models\Pita::KONDISI[$kondisi] ?? $kondisi;
@endphp
<span class="condition-dot condition-{{ $map[$kondisi] ?? 'secondary' }}"></span>
<span class="fw-semibold small">{{ $label }}</span>
