<?php

namespace Database\Seeders;

/** Sumber tunggal data contoh; file yang sama dipakai untuk database/sql/sk04_restorasi_pita.sql. */
class SeedData
{
    public static function all(): array
    {
        $path = __DIR__.'/data/sk04_data.json';

        return json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
    }
}
