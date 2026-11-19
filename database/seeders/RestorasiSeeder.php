<?php

namespace Database\Seeders;

use App\Models\Pita;
use App\Models\Peralatan;
use App\Models\Restorasi;
use App\Models\Teknisi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestorasiSeeder extends Seeder
{
    public function run(): void
    {
        $pitaId = Pita::pluck('id', 'kode_arsip');
        $teknisiId = Teknisi::pluck('id', 'nama');
        $peralatanId = Peralatan::pluck('id', 'nama');

        DB::transaction(function () use ($pitaId, $teknisiId, $peralatanId) {
            foreach (SeedData::all()['restorasi'] as $row) {
                $restorasi = Restorasi::create([
                    'pita_id' => $pitaId[$row['kode_arsip']],
                    'teknisi_id' => $row['teknisi'] ? $teknisiId[$row['teknisi']] : null,
                    'tanggal_mulai' => $row['tanggal_mulai'],
                    'tanggal_selesai' => $row['tanggal_selesai'],
                    'status' => $row['status'],
                    'biaya' => $row['biaya'],
                    'catatan' => $row['catatan'],
                ]);

                $restorasi->peralatan()->sync(array_map(fn ($n) => $peralatanId[$n], $row['peralatan']));
                $restorasi->detail()->createMany($row['detail']);
            }
        });
    }
}
