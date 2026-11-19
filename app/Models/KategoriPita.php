<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPita extends Model
{
    protected $table = 'kategori_pita';

    protected $fillable = ['nama', 'slug', 'deskripsi'];

    public function pita(): HasMany
    {
        return $this->hasMany(Pita::class);
    }
}
