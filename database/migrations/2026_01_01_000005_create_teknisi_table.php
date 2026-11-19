<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teknisi', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 120);
            $table->string('keahlian', 150)->nullable();
            $table->string('email', 150)->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teknisi');
    }
};
