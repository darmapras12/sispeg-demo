<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pegawais', function (Blueprint $blueprint) {
            // Tambahkan kolom status setelah is_dashboard_only
            // Kita beri default null (aktif)
            $blueprint->string('status')->nullable()->after('is_dashboard_only');
        });
    }

    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $blueprint) {
            $blueprint->dropColumn('status');
        });
    }
};