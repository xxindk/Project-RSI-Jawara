<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('flashcards', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('id_modul');
    $table->unsignedBigInteger('id_card');
    $table->string('kata_indo');
    $table->string('kata_jawa');
    $table->timestamps();

    $table->foreign('id_modul')
          ->references('id_modul')
          ->on('moduls')
          ->onDelete('cascade');

    $table->unique(['id_modul', 'id_card']);
});

    }

    public function down(): void
    {
        Schema::dropIfExists('flashcards');
    }
};
