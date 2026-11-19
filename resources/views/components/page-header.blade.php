@props(['title', 'subtitle' => null, 'icon' => 'bi-collection'])
<div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div class="d-flex align-items-center gap-3">
        <span class="page-icon"><i class="bi {{ $icon }}"></i></span>
        <div>
            <h1 class="h3 fw-bold mb-0">{{ $title }}</h1>
            @if ($subtitle)<p class="text-muted mb-0">{{ $subtitle }}</p>@endif
        </div>
    </div>
    <div class="d-flex gap-2">{{ $slot }}</div>
</div>
