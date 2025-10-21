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
        Schema::create('profil_users', function (Blueprint $table) {
        $table->id('id_profil');
        $table->unsignedBigInteger('id_pengguna');
        $table->string('foto_profil')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
        $table->text('alamat')->nullable();
        $table->timestamp('tanggal_diupdate')->useCurrent();
        $table->timestamps();

        $table->foreign('id_pengguna')->references('id_pengguna')->on('penggunas')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_users');
    }
};
