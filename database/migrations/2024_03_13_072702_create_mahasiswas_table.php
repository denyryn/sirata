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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->integer('id_mahasiswa')->primary();
            $table->integer('id_user');
            $table->string('nim', 25)->unique();
            $table->integer('id_kelas');
            $table->string('nama_mahasiswa', 150);
            $table->string('email_mahasiswa', 100);
            $table->string('no_telp_mahasiswa', 15);

            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};