@props(['icon' => 'bi-circle', 'label', 'value', 'tone' => 'amber'])
<div class="stat-card tone-{{ $tone }} h-100">
    <div class="stat-icon"><i class="bi {{ $icon }}"></i></div>
    <div>
        <div class="stat-label">{{ $label }}</div>
        <div class="stat-value" data-count="{{ $value }}">{{ $value }}</div>
    </div>
</div>
