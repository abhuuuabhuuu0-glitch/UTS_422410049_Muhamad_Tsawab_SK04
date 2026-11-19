<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restorasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pita_id')->constrained('pita')->cascadeOnDelete();
            $table->foreignId('teknisi_id')->nullable()->constrained('teknisi')->nullOnDelete();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status', ['menunggu', 'proses', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->decimal('biaya', 12, 2)->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['status', 'tanggal_mulai']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restorasi');
    }
};
