<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restorasi_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restorasi_id')->constrained('restorasi')->cascadeOnDelete();
            $table->enum('tahap', ['pembersihan', 'pemanggangan', 'digitasi', 'editing', 'verifikasi']);
            $table->string('tindakan', 191);
            $table->date('tanggal');
            $table->unsignedSmallInteger('durasi_menit')->default(0);
            $table->text('hasil')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restorasi_detail');
    }
};
