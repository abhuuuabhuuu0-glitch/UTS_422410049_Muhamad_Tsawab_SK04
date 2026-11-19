{{-- Pilihan jamak berbentuk chip: <x-chip name="kerusakan_ids[]" value="1" :checked="..." label="..."/> --}}
@props(['name', 'value', 'checked' => false, 'label', 'icon' => null])
<label class="chip">
    <input type="checkbox" name="{{ $name }}" value="{{ $value }}" @checked($checked) {{ $attributes }}>
    <span>
        @if ($icon)<i class="bi {{ $icon }} me-1"></i>@endif{{ $label }}
    </span>
</label>
