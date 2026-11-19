<div class="row g-4">
    <div class="col-lg-8">
        <div class="card glass-card"><div class="card-body p-4">
            <h2 class="h6 fw-bold mb-3"><i class="bi bi-journal-text text-amber me-2"></i>Data Proyek</h2>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-semibold" for="pita_id">Pita yang Direstorasi <span class="text-danger">*</span></label>
                    <select id="pita_id" name="pita_id" class="form-select form-select-lg @error('pita_id') is-invalid @enderror" required>
                        <option value="">— Pilih pita —</option>
                        @foreach ($pitaList as $p)
                            <option value="{{ $p->id }}" @selected(old('pita_id', $restorasi->pita_id) == $p->id)>{{ $p->kode_arsip }} · {{ $p->judul }} ({{ $p->kategori->nama }})</option>
                        @endforeach
                    </select>
                    @error('pita_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="teknisi_id">Teknisi</label>
                    <select id="teknisi_id" name="teknisi_id" class="form-select @error('teknisi_id') is-invalid @enderror">
                        <option value="">— Belum ditugaskan —</option>
                        @foreach ($teknisiList as $t)
                            <option value="{{ $t->id }}" @selected(old('teknisi_id', $restorasi->teknisi_id) == $t->id)>{{ $t->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="status">Status <span class="text-danger">*</span></label>
                    <select id="status" name="status" class="form-select" required>
                        @foreach ($statusList as $key => $label)
                            <option value="{{ $key }}" @selected(old('status', $restorasi->status) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="tanggal_mulai">Tanggal Mulai <span class="text-danger">*</span></label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', optional($restorasi->tanggal_mulai)->format('Y-m-d')) }}" class="form-control @error('tanggal_mulai') is-invalid @enderror" required>
                    @error('tanggal_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', optional($restorasi->tanggal_selesai)->format('Y-m-d')) }}" class="form-control @error('tanggal_selesai') is-invalid @enderror">
                    @error('tanggal_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" for="biaya">Biaya (Rp) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" inputmode="decimal" id="biaya" name="biaya" value="{{ old('biaya', $restorasi->biaya ?? 0) }}" class="form-control @error('biaya') is-invalid @enderror" data-money required>
                        @error('biaya')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold" for="catatan">Catatan</label>
                    <textarea id="catatan" name="catatan" rows="3" class="form-control" maxlength="2000">{{ old('catatan', $restorasi->catatan) }}</textarea>
                </div>
            </div>
        </div></div>
    </div>

    <div class="col-lg-4">
        <div class="card glass-card h-100"><div class="card-body p-4">
            <h2 class="h6 fw-bold mb-1"><i class="bi bi-cpu text-amber me-2"></i>Peralatan</h2>
            <p class="small text-muted mb-3">Pilihan jamak — tandai alat yang dipakai.</p>
            @php $alatTerpilih = old('peralatan_ids', $peralatanTerpilih); @endphp
            <div class="d-flex flex-wrap gap-2 chip-group" data-counter-target="#peralatanCount">
                @foreach ($peralatanList as $p)
                    <x-chip name="peralatan_ids[]" :value="$p->id" :label="$p->nama" :checked="in_array($p->id, (array) $alatTerpilih)" />
                @endforeach
            </div>
            @error('peralatan_ids.*')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
            <div class="mt-3 small text-muted">Dipilih: <strong id="peralatanCount">0</strong> alat</div>
        </div></div>
    </div>
</div>

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-amber btn-lg px-4"><i class="bi bi-save"></i> Simpan Proyek</button>
    <a href="{{ $restorasi->exists ? route('restorasi.show', $restorasi) : route('restorasi.index') }}" class="btn btn-outline-secondary btn-lg">Batal</a>
</div>
