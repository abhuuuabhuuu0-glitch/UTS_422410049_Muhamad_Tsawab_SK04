<?php

namespace Database\Seeders;

use App\Models\Kerusakan;
use App\Models\KategoriPita;
use App\Models\Peralatan;
use App\Models\Teknisi;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        $data = SeedData::all();

        foreach ($data['kategori_pita'] as $row) {
            KategoriPita::create($row);
        }
        foreach ($data['kerusakan'] as $row) {
            Kerusakan::create($row);
        }
        foreach ($data['peralatan'] as $row) {
            Peralatan::create($row);
        }
        foreach ($data['teknisi'] as $row) {
            Teknisi::create($row);
        }
    }
}
