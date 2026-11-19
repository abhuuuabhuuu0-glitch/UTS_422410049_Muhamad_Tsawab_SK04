<?php

namespace App\Services;

use App\Models\Pita;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PitaService
{
    /** Membuat pita beserta relasi pilihan jamak kerusakan dalam satu transaksi. */
    public function create(array $data, array $kerusakanIds = []): Pita
    {
        return DB::transaction(function () use ($data, $kerusakanIds) {
            $pita = Pita::create($data);
            $pita->kerusakan()->sync($kerusakanIds);

            return $pita->load('kategori', 'kerusakan');
        });
    }

    public function update(Pita $pita, array $data, array $kerusakanIds = []): Pita
    {
        return DB::transaction(function () use ($pita, $data, $kerusakanIds) {
            $pita->update($data);
            $pita->kerusakan()->sync($kerusakanIds);

            return $pita->refresh();
        });
    }

    /** Menolak penghapusan jika pita masih memiliki restorasi aktif. */
    public function delete(Pita $pita): void
    {
        DB::transaction(function () use ($pita) {
            $aktif = $pita->restorasi()->whereIn('status', ['menunggu', 'proses'])->exists();

            if ($aktif) {
                throw ValidationException::withMessages([
                    'pita' => 'Pita tidak dapat dihapus karena masih memiliki restorasi yang aktif.',
                ]);
            }

            $pita->delete();
        });
    }
}
