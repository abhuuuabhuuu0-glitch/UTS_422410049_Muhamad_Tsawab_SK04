<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestorasiDetail extends Model
{
    public const TAHAP = [
        'pembersihan' => 'Pembersihan',
        'pemanggangan' => 'Pemanggangan (Baking)',
        'digitasi' => 'Digitasi',
        'editing' => 'Editing Audio/Video',
        'verifikasi' => 'Verifikasi',
    ];

    protected $table = 'restorasi_detail';

    protected $fillable = ['restorasi_id', 'tahap', 'tindakan', 'tanggal', 'durasi_menit', 'hasil'];

    protected function casts(): array
    {
        return ['tanggal' => 'date'];
    }

    public function restorasi(): BelongsTo
    {
        return $this->belongsTo(Restorasi::class);
    }

    public function getTahapLabelAttribute(): string
    {
        return self::TAHAP[$this->tahap] ?? $this->tahap;
    }
}
