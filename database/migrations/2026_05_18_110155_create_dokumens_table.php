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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            // Menghubungkan berkas ke ID pegawai, jika pegawai dihapus maka berkas otomatis terhapus (cascade)
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
            $table->string('jenis_dokumen'); // Berisi teks ketik manual dari admin (Ijazah, SK, dll)
            $table->string('nama_file');    // Nama file asli (misal: ijazah_darma.pdf)
            $table->string('path_file');    // Lokasi file tersimpan di storage (misal: berkas_pegawai/file.pdf)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
