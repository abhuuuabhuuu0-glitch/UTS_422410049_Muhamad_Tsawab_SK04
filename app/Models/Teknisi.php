<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teknisi extends Model
{
    protected $table = 'teknisi';

    protected $fillable = ['nama', 'keahlian', 'email'];

    public function restorasi(): HasMany
    {
        return $this->hasMany(Restorasi::class);
    }
}
