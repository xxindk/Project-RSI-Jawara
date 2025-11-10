<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_kuis', function (Blueprint $table) {
            $table->id('id_hasil');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_modul');
            $table->integer('jumlah_benar')->default(0);
            $table->integer('skor')->default(0);
            $table->timestamp('tanggal_kerja')->nullable();
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('penggunas')->onDelete('cascade');
            $table->foreign('id_modul')->references('id_modul')->on('moduls')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_kuis');
    }
};
