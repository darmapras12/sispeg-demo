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
        $table->date('tanggal_mutasi')->nullable()->after('catatan_status');
        $table->date('tanggal_pensiun')->nullable()->after('tanggal_mutasi');
    });
}

public function down(): void
{
    Schema::table('pegawais', function (Blueprint $table) {
        $table->dropColumn(['tanggal_mutasi', 'tanggal_pensiun']);
    });
}
};
