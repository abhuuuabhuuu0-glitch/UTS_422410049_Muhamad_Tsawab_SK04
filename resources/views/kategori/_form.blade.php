<div class="card glass-card">
    <div class="card-body p-4">
        <div class="mb-3">
            <label class="form-label fw-semibold" for="nama">Nama Kategori <span class="text-danger">*</span></label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}"
                   class="form-control form-control-lg @error('nama') is-invalid @enderror" maxlength="100" required>
            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="form-label fw-semibold" for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" maxlength="500"
                      class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-amber px-4"><i class="bi bi-save"></i> Simpan</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </div>
</div>
