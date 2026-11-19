<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pita', function (Blueprint $table) {
            $table->id();
            $table->string('kode_arsip', 30)->unique();
            $table->string('judul', 191);
            $table->foreignId('kategori_pita_id')->constrained('kategori_pita')->restrictOnDelete();
            $table->unsignedSmallInteger('tahun_rekaman')->nullable();
            $table->unsignedSmallInteger('durasi_menit')->nullable();
            $table->enum('kondisi', ['baik', 'sedang', 'rusak_berat'])->default('sedang');
            $table->string('lokasi_simpan', 150)->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->index(['kategori_pita_id', 'kondisi']);
            $table->index('judul');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pita');
    }
};
