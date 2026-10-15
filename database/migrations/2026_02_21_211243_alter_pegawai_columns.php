<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->text('diklat_nama')->nullable()->change();
            $table->text('diklat_tahun')->nullable()->change();
            $table->text('diklat_durasi')->nullable()->change();
            $table->text('pendidikan_nama')->nullable()->change();
            $table->text('pendidikan_tahun')->nullable()->change();
            $table->text('pendidikan_ijazah')->nullable()->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
