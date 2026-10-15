<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Pegawai;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Facades\Hash;

class MutasiPegawaiTest extends DuskTestCase
{
    public function test_alur_lengkap_sistem_pegawai()
    {
        // 1. Persiapan User
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin Testing', 'password' => Hash::make('adminsispeg')]
        );

        // 2. Ambil data pegawai aktif
        $pegawaiMutasi = Pegawai::whereNull('status')->first();
        $pegawaiPensiun = Pegawai::whereNull('status')->offset(1)->first() ?: $pegawaiMutasi;

        $this->browse(function (Browser $browser) use ($pegawaiMutasi, $pegawaiPensiun) {
            $browser->maximize() 
                    
                    // --- 1. LOGIN ---
                    ->visit('/')
                    ->type('email', 'admin@gmail.com')
                    ->type('password', 'adminsispeg')
                    ->press('MASUK') 
                    ->pause(900) 

                    // --- 2. DASHBOARD ---
                    ->assertPathIs('/admin/dashboard')
                    ->pause(900)

                    // --- 3. DATA PEGAWAI (MASTER) ---
                    ->visit('/admin/data-pegawai')
                    ->waitFor('table', 15)
                    ->assertSee($pegawaiMutasi->nama_lengkap)
                    ->pause(2000)

                    // --- 4. SIMULASI MUTASI ---
                    // Menggunakan selector yang mencari tombol di dalam baris (TR) pegawai terkait
                    ->with("tr:contains('{$pegawaiMutasi->nama_lengkap}')", function ($row) {
                        // Mencari tombol yang memiliki kata 'Mutasi' (baik di teks atau atribut title/data)
                        // Jika tombol Anda hanya icon, kita gunakan selector data-bs-target yang mengandung kata 'Mutasi'
                        $row->click("button[data-bs-target*='Mutasi']"); 
                    })
                    ->pause(2000) 
                    
                    ->keys('input[name="tanggal_mutasi"]', '20', '01', '2026') 
                    ->type('textarea[name="catatan"]', 'Tes Mutasi Otomatis via Dusk')
                    ->pause(1000)
                    ->press('Pindahkan ke Mutasi') 
                    
                    ->pause(3000)
                    ->assertPathIs('/admin/data-pegawai')
                    ->screenshot('02_setelah_mutasi')

                    // --- 5. SATYALANCANA ---
                    ->visit('/admin/pegawai/satyalancana')
                    ->waitForText('Satyalancana', 10)
                    ->pause(2000)

                    // --- 6. SIMULASI PENSIUN ---
                    ->visit('/admin/data-pegawai')
                    ->waitFor('table', 15)
                    ->pause(2000)
                    
                    // Klik tombol pensiun di baris pegawai terkait
                    ->with("tr:contains('{$pegawaiPensiun->nama_lengkap}')", function ($row) {
                        $row->click("button[data-bs-target*='Pensiun']");
                    })
                    ->pause(2000)
                    ->keys('input[name="tanggal_pensiun"]', '20', '01', '2026')
                    ->pause(1000)
                    ->press('Pindahkan ke Pensiun')
                    
                    ->pause(3000)
                    ->assertPathIs('/admin/data-pegawai')
                    ->screenshot('04_final_pensiun');
        });
    }
}