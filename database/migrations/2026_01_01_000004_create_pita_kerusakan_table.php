<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pita_kerusakan', function (Blueprint $table) {
            $table->foreignId('pita_id')->constrained('pita')->cascadeOnDelete();
            $table->foreignId('kerusakan_id')->constrained('kerusakan')->cascadeOnDelete();
            $table->primary(['pita_id', 'kerusakan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pita_kerusakan');
    }
};
