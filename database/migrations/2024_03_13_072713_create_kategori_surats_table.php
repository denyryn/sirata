<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_surats', function (Blueprint $table) {
            $table->bigIncrements('id_kategori_surat');
            $table->string('nama_kategori');
            $table->enum('peruntukkan', ['dosen', 'mahasiswa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_surats');
    }
};
