<div class="row g-4">
    <div class="col-lg-8">
        <div class="card glass-card h-100"><div class="card-body p-4">
            <h2 class="h6 fw-bold mb-3"><i class="bi bi-info-circle text-amber me-2"></i>Identitas Pita</h2>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="kode_arsip">Kode Arsip <span class="text-danger">*</span></label>
                    <input id="kode_arsip" name="kode_arsip" value="{{ old('kode_arsip', $pita->kode_arsip) }}" class="form-control text-uppercase @error('kode_arsip') is-invalid @enderror" placeholder="PA-OR-0009" maxlength="30" required>
                    @error('kode_arsip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="kategori_pita_id">Kategori <span class="text-danger">*</span></label>
                    <select id="kategori_pita_id" name="kategori_pita_id" class="form-select @error('kategori_pita_id') is-invalid @enderror" required>
                        <option value="">— Pilih kategori —</option>
                        @foreach ($kategoriList as $k)
                            <option value="{{ $k->id }}" @selected(old('kategori_pita_id', $pita->kategori_pita_id) == $k->id)>{{ $k->nama }}</option>
                        @endforeach
                    </select>
                    @error('kategori_pita_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold" for="judul">Judul Rekaman <span class="text-danger">*</span></label>
                    <input id="judul" name="judul" value="{{ old('judul', $pita->judul) }}" class="form-control @error('judul') is-invalid @enderror" maxlength="191" required>
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" for="tahun_rekaman">Tahun Rekaman</label>
                    <input type="number" id="tahun_rekaman" name="tahun_rekaman" value="{{ old('tahun_rekaman', $pita->tahun_rekaman) }}" class="form-control @error('tahun_rekaman') is-invalid @enderror" min="1900" max="{{ now()->year }}">
                    @error('tahun_rekaman')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" for="durasi_menit">Durasi (menit)</label>
                    <input type="number" id="durasi_menit" name="durasi_menit" value="{{ old('durasi_menit', $pita->durasi_menit) }}" class="form-control @error('durasi_menit') is-invalid @enderror" min="1" max="1440">
                    @error('durasi_menit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" for="kondisi">Kondisi <span class="text-danger">*</span></label>
                    <select id="kondisi" name="kondisi" class="form-select @error('kondisi') is-invalid @enderror" required>
                        @foreach ($kondisiList as $key => $label)
                            <option value="{{ $key }}" @selected(old('kondisi', $pita->kondisi ?? 'sedang') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('kondisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="lokasi_simpan">Lokasi Penyimpanan</label>
                    <input id="lokasi_simpan" name="lokasi_simpan" value="{{ old('lokasi_simpan', $pita->lokasi_simpan) }}" class="form-control" maxlength="150" placeholder="Rak A-01">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold" for="deskripsi">Catatan / Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control" maxlength="2000">{{ old('deskripsi', $pita->deskripsi) }}</textarea>
                </div>
            </div>
        </div></div>
    </div>

    <div class="col-lg-4">
        <div class="card glass-card h-100"><div class="card-body p-4">
            <h2 class="h6 fw-bold mb-1"><i class="bi bi-exclamation-triangle text-amber me-2"></i>Kerusakan Fisik</h2>
            <p class="small text-muted mb-3">Pilihan jamak — centang semua kerusakan yang ditemukan.</p>
            @php $terpilih = old('kerusakan_ids', $kerusakanTerpilih ?? []); @endphp
            <div class="d-flex flex-wrap gap-2 chip-group" data-counter-target="#kerusakanCount">
                @foreach ($kerusakanList as $kr)
                    <x-chip name="kerusakan_ids[]" :value="$kr->id" :label="$kr->nama"
                            :checked="in_array($kr->id, (array) $terpilih)" icon="bi-bug" />
                @endforeach
            </div>
            @error('kerusakan_ids.*')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
            <div class="mt-3 small text-muted">Dipilih: <strong id="kerusakanCount">0</strong> kerusakan</div>
        </div></div>
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-amber btn-lg px-4"><i class="bi bi-save"></i> Simpan Pita</button>
    <a href="{{ $pita->exists ? route('pita.show', $pita) : route('pita.index') }}" class="btn btn-outline-secondary btn-lg">Batal</a>
</div>
