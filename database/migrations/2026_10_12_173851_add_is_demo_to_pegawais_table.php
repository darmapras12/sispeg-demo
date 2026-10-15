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
        if (!Schema::hasTable('dokumens')) {
            Schema::create('dokumens', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
                $table->string('jenis_dokumen');
                $table->string('nama_file');
                $table->string('path_file');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};