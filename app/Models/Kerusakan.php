<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kerusakan extends Model
{
    protected $table = 'kerusakan';

    protected $fillable = ['nama', 'deskripsi'];

    public function pita(): BelongsToMany
    {
        return $this->belongsToMany(Pita::class, 'pita_kerusakan');
    }
}
