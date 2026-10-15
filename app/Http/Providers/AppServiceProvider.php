<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Pegawai;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (Schema::hasTable('pegawais')) {

            // 2 bulan sebelum hari H
            $batasWaktu = Carbon::now()->addMonths(2);

            // ================= KP =================
            $notifKP = Pegawai::whereNull('status')
                ->whereNotNull('next_kp')
                ->where('next_kp', '<=', $batasWaktu)
                ->orderBy('next_kp', 'asc')
                ->get();

            // ================= KGB =================
            $notifKGB = Pegawai::whereNull('status')
                ->whereNotNull('next_kgb')
                ->where('next_kgb', '<=', $batasWaktu)
                ->orderBy('next_kgb', 'asc')
                ->get();

            // Share global
            View::share('notifKP', $notifKP);
            View::share('notifKGB', $notifKGB);
            View::share('countKP', $notifKP->count());
            View::share('countKGB', $notifKGB->count());
        }
    }
}
