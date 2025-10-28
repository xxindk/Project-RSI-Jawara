<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flashcards', function (Blueprint $table) {
            $table->id(); // primary key auto-increment
            $table->unsignedBigInteger('id_modul'); // foreign key ke modul
            $table->unsignedBigInteger('id_card'); // nomor flashcard dalam modul
            $table->string('kata_indo');
            $table->string('kata_jawa');
            $table->timestamps();

            // foreign key
            $table->foreign('id_modul')->references('id')->on('moduls')->onDelete('cascade');
            
            // optional: supaya id_card unik per modul
            $table->unique(['id_modul', 'id_card']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flashcards');
    }
};
