<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restorasi_peralatan', function (Blueprint $table) {
            $table->foreignId('restorasi_id')->constrained('restorasi')->cascadeOnDelete();
            $table->foreignId('peralatan_id')->constrained('peralatan')->cascadeOnDelete();
            $table->primary(['restorasi_id', 'peralatan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restorasi_peralatan');
    }
};
