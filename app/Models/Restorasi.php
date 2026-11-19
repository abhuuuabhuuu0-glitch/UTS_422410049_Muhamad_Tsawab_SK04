<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restorasi extends Model
{
    public const STATUS = [
        'menunggu' => 'Menunggu',
        'proses' => 'Dalam Proses',
        'selesai' => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
    ];

    protected $table = 'restorasi';

    protected $fillable = [
        'pita_id', 'teknisi_id', 'tanggal_mulai', 'tanggal_selesai',
        'status', 'biaya', 'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'biaya' => 'decimal:2',
        ];
    }

    public function pita(): BelongsTo
    {
        return $this->belongsTo(Pita::class);
    }

    public function teknisi(): BelongsTo
    {
        return $this->belongsTo(Teknisi::class);
    }

    public function detail(): HasMany
    {
        return $this->hasMany(RestorasiDetail::class)->orderBy('tanggal')->orderBy('id');
    }

    public function peralatan(): BelongsToMany
    {
        return $this->belongsToMany(Peralatan::class, 'restorasi_peralatan');
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS[$this->status] ?? $this->status;
    }

    public function getTotalDurasiAttribute(): int
    {
        return (int) $this->detail->sum('durasi_menit');
    }

    public function scopeCari(Builder $query, ?string $keyword): Builder
    {
        return $query->when($keyword, fn (Builder $q) => $q->whereHas(
            'pita', fn (Builder $p) => $p->where('judul', 'like', "%{$keyword}%")
                ->orWhere('kode_arsip', 'like', "%{$keyword}%")
        ));
    }

    public function scopeFilterStatus(Builder $query, ?string $status): Builder
    {
        return $query->when($status, fn (Builder $q) => $q->where('status', $status));
    }

    public function scopeFilterTeknisi(Builder $query, ?int $teknisiId): Builder
    {
        return $query->when($teknisiId, fn (Builder $q) => $q->where('teknisi_id', $teknisiId));
    }

    /** Pilihan jamak: restorasi yang memakai salah satu peralatan yang dipilih. */
    public function scopeFilterPeralatan(Builder $query, array $peralatanIds): Builder
    {
        return $query->when($peralatanIds, fn (Builder $q) => $q->whereHas(
            'peralatan', fn (Builder $p) => $p->whereIn('peralatan.id', $peralatanIds)
        ));
    }
}
