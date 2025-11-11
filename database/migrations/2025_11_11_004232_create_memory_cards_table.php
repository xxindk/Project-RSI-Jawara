<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
    {
        Schema::create('memory_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_modul');
            $table->unsignedBigInteger('id_card')->unique();
            $table->string('word');
            $table->unsignedBigInteger('pair_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memory_cards');
    }

};
