<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('modul_id')->nullable();
            $table->enum('status', ['belum', 'sedang', 'selesai'])->default('belum');
            $table->timestamps();

            // Relasi opsional (hapus kalau belum ada tabel terkait)
            $table->foreign('user_id')->references('id')->on('penggunas')->onDelete('cascade');
            $table->foreign('modul_id')->references('id')->on('moduls')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};