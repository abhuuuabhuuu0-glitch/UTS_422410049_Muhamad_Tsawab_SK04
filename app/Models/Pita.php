<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pita extends Model
{
    public const KONDISI = [
        'baik' => 'Baik',
        'sedang' => 'Sedang',
        'rusak_berat' => 'Rusak Berat',
    ];

    protected $table = 'pita';

    protected $fillable = [
        'kode_arsip', 'judul', 'kategori_pita_id', 'tahun_rekaman',
        'durasi_menit', 'kondisi', 'lokasi_simpan', 'deskripsi',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriPita::class, 'kategori_pita_id');
    }

    public function kerusakan(): BelongsToMany
    {
        return $this->belongsToMany(Kerusakan::class, 'pita_kerusakan');
    }

    public function restorasi(): HasMany
    {
        return $this->hasMany(Restorasi::class);
    }

    public function getKondisiLabelAttribute(): string
    {
        return self::KONDISI[$this->kondisi] ?? $this->kondisi;
    }

    public function scopeCari(Builder $query, ?string $keyword): Builder
    {
        return $query->when($keyword, fn (Builder $q) => $q->where(function (Builder $w) use ($keyword) {
            $w->where('judul', 'like', "%{$keyword}%")
                ->orWhere('kode_arsip', 'like', "%{$keyword}%")
                ->orWhere('lokasi_simpan', 'like', "%{$keyword}%");
        }));
    }

    public function scopeFilterKategori(Builder $query, ?int $kategoriId): Builder
    {
        return $query->when($kategoriId, fn (Builder $q) => $q->where('kategori_pita_id', $kategoriId));
    }

    public function scopeFilterKondisi(Builder $query, ?string $kondisi): Builder
    {
        return $query->when($kondisi, fn (Builder $q) => $q->where('kondisi', $kondisi));
    }

    /** Pilihan jamak: pita yang memiliki salah satu dari kerusakan yang dipilih. */
    public function scopeFilterKerusakan(Builder $query, array $kerusakanIds): Builder
    {
        return $query->when($kerusakanIds, fn (Builder $q) => $q->whereHas(
            'kerusakan', fn (Builder $k) => $k->whereIn('kerusakan.id', $kerusakanIds)
        ));
    }
}
