@props(['status'])
@php
    $map = [
        'menunggu' => ['warning', 'bi-hourglass-split'],
        'proses' => ['primary', 'bi-arrow-repeat'],
        'selesai' => ['success', 'bi-check2-circle'],
        'dibatalkan' => ['secondary', 'bi-x-circle'],
    ];
    [$color, $icon] = $map[$status] ?? ['secondary', 'bi-question-circle'];
    $label = \App\Models\Restorasi::STATUS[$status] ?? $status;
@endphp
<span class="badge rounded-pill badge-soft badge-{{ $color }}"><i class="bi {{ $icon }} me-1"></i>{{ $label }}</span>
