<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Pegawai; // IMPORT MODEL PEGAWAI
use Illuminate\Support\Facades\View; // IMPORT FACADE VIEW

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Membagikan jumlah mutasi & pensiun ke view bilah_samping secara otomatis
        View::composer('komponen.bilah_samping', function ($view) {
            $view->with('countMutasi', Pegawai::where('status', 'mutasi')->count());
            $view->with('countPensiun', Pegawai::where('status', 'pensiun')->count());
        });
    }
}