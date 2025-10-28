<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moduls', function (Blueprint $table) {
            $table->id('id_modul');
            $table->string('judul_modul', 100);
            $table->text('deskripsi')->nullable();
            $table->integer('nomor_urut');
            $table->string('tingkatan_bahasa', 50);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moduls');
    }
};
