<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /** Mengosongkan tabel data (urutan aman untuk FK), lalu mengisi ulang dari sk04_data.json. */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        foreach (['restorasi_peralatan', 'restorasi_detail', 'restorasi', 'pita_kerusakan', 'pita',
                  'kerusakan', 'teknisi', 'peralatan', 'kategori_pita'] as $table) {
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints();

        $this->call([
            MasterDataSeeder::class,
            PitaSeeder::class,
            RestorasiSeeder::class,
        ]);
    }
}
