<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique(); // NIP wajib unik
            $table->string('nama_lengkap');
            $table->string('jabatan')->nullable();
            $table->string('pangkat_golongan')->nullable();

            // Data Tanggal (Dari Inputan/Excel)
            $table->date('tmt_pangkat_terakhir')->nullable();
            $table->date('tmt_kgb_terakhir')->nullable();

            // Data Tanggal (Hasil Hitungan Sistem)
            $table->date('next_kp')->nullable();
            $table->date('next_kgb')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
};