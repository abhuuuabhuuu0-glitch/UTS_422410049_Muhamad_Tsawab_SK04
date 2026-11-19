<div class="card glass-card">
    <div class="card-body p-0">
        <div class="d-flex justify-content-between align-items-center px-4 pt-3">
            <span class="small text-muted"><span data-total>{{ $pitaList->total() }}</span> pita ditemukan</span>
        </div>
        <div class="table-responsive p-3 pt-2">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kode Arsip</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                        <th>Kondisi</th>
                        <th>Kerusakan</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($pitaList as $pita)
                    <tr class="row-enter">
                        <td><code class="code-chip">{{ $pita->kode_arsip }}</code></td>
                        <td>
                            <a href="{{ route('pita.show', $pita) }}" class="fw-semibold text-decoration-none title-link">{{ $pita->judul }}</a>
                            <div class="small text-muted"><i class="bi bi-geo-alt"></i> {{ $pita->lokasi_simpan ?? '—' }}</div>
                        </td>
                        <td><span class="badge badge-soft badge-amber">{{ $pita->kategori->nama }}</span></td>
                        <td>{{ $pita->tahun_rekaman ?? '—' }}</td>
                        <td><x-kondisi-badge :kondisi="$pita->kondisi" /></td>
                        <td>
                            @forelse ($pita->kerusakan as $kr)
                                <span class="mini-tag">{{ $kr->nama }}</span>
                            @empty
                                <span class="text-muted small">Tidak ada</span>
                            @endforelse
                        </td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('pita.show', $pita) }}" class="btn btn-sm btn-icon" title="Lihat"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('pita.edit', $pita) }}" class="btn btn-sm btn-icon" title="Ubah"><i class="bi bi-pencil"></i></a>
                            <x-delete-form :action="route('pita.destroy', $pita)" :message="'Hapus pita '.$pita->judul.'?'" :label="''" :small="true" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7"><x-empty-state message="Tidak ada pita yang cocok dengan filter." /></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 pb-3">{{ $pitaList->links() }}</div>
    </div>
</div>
