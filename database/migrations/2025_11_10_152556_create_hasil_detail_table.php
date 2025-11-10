<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_hasil');
            $table->unsignedBigInteger('id_kuis');
            $table->enum('jawaban_terpilih', ['A','B','C','D'])->nullable();
            $table->boolean('benar')->default(false);
            $table->timestamps();

            $table->foreign('id_hasil')->references('id_hasil')->on('hasil_kuis')->onDelete('cascade');
            $table->foreign('id_kuis')->references('id_kuis')->on('kuis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_detail');
    }
};
