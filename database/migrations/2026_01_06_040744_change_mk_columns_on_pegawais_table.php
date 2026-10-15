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
    Schema::table('pegawais', function (Blueprint $table) {
        $table->integer('mk_tahun')->default(0)->change();
        $table->integer('mk_bulan')->default(0)->change();
        // Tambahkan kolom lain jika masih ada yang error
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
