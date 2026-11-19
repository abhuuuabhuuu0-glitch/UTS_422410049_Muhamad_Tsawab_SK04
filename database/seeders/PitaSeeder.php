<?php

namespace Database\Seeders;

use App\Models\Kerusakan;
use App\Models\KategoriPita;
use App\Models\Pita;
use Illuminate\Database\Seeder;

class PitaSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriId = KategoriPita::pluck('id', 'nama');
        $kerusakanId = Kerusakan::pluck('id', 'nama');

        foreach (SeedData::all()['pita'] as $row) {
            $pita = Pita::create([
                'kode_arsip' => $row['kode_arsip'],
                'judul' => $row['judul'],
                'kategori_pita_id' => $kategoriId[$row['kategori']],
                'tahun_rekaman' => $row['tahun_rekaman'],
                'durasi_menit' => $row['durasi_menit'],
                'kondisi' => $row['kondisi'],
                'lokasi_simpan' => $row['lokasi_simpan'],
                'deskripsi' => $row['deskripsi'],
            ]);

            // Pilihan jamak: relasi many-to-many pita <-> kerusakan
            $pita->kerusakan()->sync(array_map(fn ($nama) => $kerusakanId[$nama], $row['kerusakan']));
        }
    }
}
