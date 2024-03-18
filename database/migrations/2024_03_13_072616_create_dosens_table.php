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
        Schema::create('dosens', function (Blueprint $table) {
            $table->integer('id_dosen')->primary();
            $table->integer('id_user');
            $table->string('nip', 25)->unique();
            $table->integer('id_tanda_tangan');
            $table->integer('id_jabatan');
            $table->string('nama_dosen', 150);

            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};