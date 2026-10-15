<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            // Menambah kolom yang belum ada
            if (!Schema::hasColumn('pegawais', 'tmt_jabatan')) {
                $table->date('tmt_jabatan')->nullable()->after('jabatan');
            }
            if (!Schema::hasColumn('pegawais', 'mk_tahun')) {
                $table->integer('mk_tahun')->default(0)->after('tmt_jabatan');
            }
            if (!Schema::hasColumn('pegawais', 'mk_bulan')) {
                $table->integer('mk_bulan')->default(0)->after('mk_tahun');
            }
            if (!Schema::hasColumn('pegawais', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('mk_bulan');
            }
            
            // Kolom Diklat
            $table->string('diklat_nama')->nullable()->after('tanggal_lahir');
            $table->integer('diklat_tahun')->nullable()->after('diklat_nama');
            $table->string('diklat_durasi')->nullable()->after('diklat_tahun');

            // Kolom Pendidikan
            $table->string('pendidikan_nama')->nullable()->after('diklat_durasi');
            $table->integer('pendidikan_tahun')->nullable()->after('pendidikan_nama');
            $table->string('pendidikan_ijazah')->nullable()->after('pendidikan_tahun');
        });
    }

    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->dropColumn([
                'tmt_jabatan', 'mk_tahun', 'mk_bulan', 'tanggal_lahir',
                'diklat_nama', 'diklat_tahun', 'diklat_durasi',
                'pendidikan_nama', 'pendidikan_tahun', 'pendidikan_ijazah'
            ]);
        });
    }
};