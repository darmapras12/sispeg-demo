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
            // Cek dulu apakah kolomnya sudah ada (untuk mencegah error duplicate)
            if (!Schema::hasColumn('pegawais', 'tmt_pangkat')) {
                $table->date('tmt_pangkat')->nullable()->after('pangkat_golongan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            if (Schema::hasColumn('pegawais', 'tmt_pangkat')) {
                $table->dropColumn('tmt_pangkat');
            }
        });
    }
};