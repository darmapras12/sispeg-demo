<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Jika tabel sudah ada, kita hapus dulu agar bisa dibuat ulang dengan struktur baru
        Schema::dropIfExists('pendidikans');

        Schema::create('pendidikans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel pegawais
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
            
            $table->string('pendidikan_nama')->nullable(); 
            $table->string('pendidikan_tahun')->nullable();
            $table->string('pendidikan_ijazah')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendidikans');
    }
};