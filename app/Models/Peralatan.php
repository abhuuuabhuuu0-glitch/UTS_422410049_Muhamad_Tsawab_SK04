<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Peralatan extends Model
{
    public const JENIS = [
        'pemutar' => 'Pemutar',
        'pembersih' => 'Pembersih',
        'digitasi' => 'Digitasi',
        'lainnya' => 'Lainnya',
    ];

    protected $table = 'peralatan';

    protected $fillable = ['nama', 'jenis'];

    public function restorasi(): BelongsToMany
    {
        return $this->belongsToMany(Restorasi::class, 'restorasi_peralatan');
    }
}
