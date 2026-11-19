@props(['message' => 'Belum ada data.'])
<div class="empty-state text-center py-5">
    <div class="empty-reel mb-3"><i class="bi bi-disc"></i></div>
    <p class="text-muted mb-0">{{ $message }}</p>
    {{ $slot }}
</div>
