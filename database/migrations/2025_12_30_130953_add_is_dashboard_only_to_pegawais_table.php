<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            // Hanya tambah jika kolom belum ada
            if (!Schema::hasColumn('pegawais', 'is_dashboard_only')) {
                $table->boolean('is_dashboard_only')->default(false)->after('nip');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            // Hanya hapus jika kolom memang ada
            if (Schema::hasColumn('pegawais', 'is_dashboard_only')) {
                $table->dropColumn('is_dashboard_only');
            }
        });
    }
};