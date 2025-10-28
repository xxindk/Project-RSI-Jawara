<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id('id_materi');
            $table->unsignedBigInteger('id_modul');
            $table->text('konten_teks');
            $table->timestamps();

            $table->foreign('id_modul')->references('id_modul')->on('moduls')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
