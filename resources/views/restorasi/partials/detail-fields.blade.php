@php $p = $prefix ?? 'add'; @endphp
<div class="row g-3">
    <div class="col-12">
        <label class="form-label fw-semibold" for="{{ $p }}_tahap">Tahap <span class="text-danger">*</span></label>
        <select id="{{ $p }}_tahap" name="tahap" class="form-select" required data-field="tahap">
            @foreach ($tahapList as $key => $label)
                <option value="{{ $key }}" @selected(old('tahap') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold" for="{{ $p }}_tindakan">Tindakan <span class="text-danger">*</span></label>
        <input id="{{ $p }}_tindakan" name="tindakan" value="{{ old('tindakan') }}" class="form-control @error('tindakan') is-invalid @enderror" maxlength="191" required data-field="tindakan" placeholder="contoh: Baking 52°C selama 8 jam">
        @error('tindakan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-7">
        <label class="form-label fw-semibold" for="{{ $p }}_tanggal">Tanggal <span class="text-danger">*</span></label>
        <input type="date" id="{{ $p }}_tanggal" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" class="form-control @error('tanggal') is-invalid @enderror" required data-field="tanggal">
        @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-5">
        <label class="form-label fw-semibold" for="{{ $p }}_durasi">Menit <span class="text-danger">*</span></label>
        <input type="number" min="0" max="10080" id="{{ $p }}_durasi" name="durasi_menit" value="{{ old('durasi_menit', 0) }}" class="form-control @error('durasi_menit') is-invalid @enderror" required data-field="durasi_menit">
        @error('durasi_menit')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label fw-semibold" for="{{ $p }}_hasil">Hasil</label>
        <textarea id="{{ $p }}_hasil" name="hasil" rows="2" class="form-control" maxlength="2000" data-field="hasil">{{ old('hasil') }}</textarea>
    </div>
</div>
