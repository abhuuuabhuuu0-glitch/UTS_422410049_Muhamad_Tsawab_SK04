<div class="card glass-card">
    <div class="card-body p-0">
        <div class="px-4 pt-3 small text-muted"><span data-total>{{ $restorasiList->total() }}</span> proyek ditemukan</div>
        <div class="table-responsive p-3 pt-2">
            <table class="table table-hover align-middle mb-0">
                <thead><tr><th>Pita</th><th>Teknisi</th><th>Periode</th><th>Tahap</th><th>Biaya</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
                <tbody>
                @forelse ($restorasiList as $r)
                    <tr class="row-enter">
                        <td>
                            <a href="{{ route('restorasi.show', $r) }}" class="fw-semibold text-decoration-none title-link">{{ $r->pita->judul }}</a>
                            <div><code class="code-chip">{{ $r->pita->kode_arsip }}</code></div>
                        </td>
                        <td>{{ $r->teknisi->nama ?? '—' }}</td>
                        <td class="small">
                            {{ $r->tanggal_mulai->format('d M Y') }}
                            @if ($r->tanggal_selesai)<br><span class="text-muted">s/d {{ $r->tanggal_selesai->format('d M Y') }}</span>@endif
                        </td>
                        <td><span class="badge badge-soft badge-primary">{{ $r->detail_count }} tahap</span></td>
                        <td class="fw-semibold">Rp {{ number_format($r->biaya, 0, ',', '.') }}</td>
                        <td><x-status-badge :status="$r->status" /></td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('restorasi.show', $r) }}" class="btn btn-sm btn-icon" title="Detail"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('restorasi.edit', $r) }}" class="btn btn-sm btn-icon" title="Ubah"><i class="bi bi-pencil"></i></a>
                            <x-delete-form :action="route('restorasi.destroy', $r)" message="Hapus proyek restorasi ini beserta seluruh tahapannya?" :label="''" :small="true" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7"><x-empty-state message="Tidak ada proyek yang cocok dengan filter." /></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 pb-3">{{ $restorasiList->links() }}</div>
    </div>
</div>
