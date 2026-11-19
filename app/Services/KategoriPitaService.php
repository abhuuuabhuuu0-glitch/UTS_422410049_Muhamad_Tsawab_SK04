<?php

namespace App\Services;

use App\Models\KategoriPita;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class KategoriPitaService
{
    public function create(array $data): KategoriPita
    {
        $data['slug'] = Str::slug($data['nama']);

        return KategoriPita::create($data);
    }

    public function update(KategoriPita $kategori, array $data): KategoriPita
    {
        $data['slug'] = Str::slug($data['nama']);
        $kategori->update($data);

        return $kategori;
    }

    public function delete(KategoriPita $kategori): void
    {
        if ($kategori->pita()->exists()) {
            throw ValidationException::withMessages([
                'kategori' => 'Kategori tidak dapat dihapus karena masih dipakai oleh pita.',
            ]);
        }

        $kategori->delete();
    }
}
