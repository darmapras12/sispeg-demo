<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PensiunController;

// --- HALAMAN UTAMA (LOGIN) ---
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- FITUR DEMO GUEST (UNTUK PORTOFOLIO) ---
Route::get('/login-demo', [AuthController::class, 'loginDemo'])->name('login.demo');

// --- FITUR LUPA PASSWORD ---
Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password/update', [AuthController::class, 'updatePasswordLangsung'])->name('password.update.langsung');

// --- HALAMAN CEK NIP (AKSES PUBLIK) ---
Route::get('/cari-nip', [PegawaiController::class, 'halamanCek'])->name('cek.halaman');
Route::post('/cari', [PegawaiController::class, 'cariNip'])->name('cek.cari');

// --- HALAMAN ADMIN (DILINDUNGI LOGIN) ---
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // 1. Dashboard Utama (Monitoring KP/KGB)
    Route::get('/dashboard', [PegawaiController::class, 'index'])->name('dashboard');
    
    // 2. Database Master (Seluruh Data Pegawai)
    Route::get('/data-pegawai', [PegawaiController::class, 'indexData'])->name('pegawai.data');
    
    // 3. Fitur Mutasi & Pensiun (Halaman List)
    Route::get('/mutasi', [MutasiController::class, 'index'])->name('mutasi.index');
    Route::get('/pensiun', [PensiunController::class, 'index'])->name('pensiun.index');

    // --- FITUR SATYALANCANA ---
    Route::get('/pegawai/satyalancana', [PegawaiController::class, 'satya'])->name('pegawai.satya');

    // --- FITUR OPERASIONAL PEGAWAI (DITAROH SEBELUM ROUTE RESOURCE AGAR TIDAK BENTROK) ---
    Route::get('/pegawai-export', [PegawaiController::class, 'export'])->name('pegawai.export');
    Route::post('/pegawai-import', [PegawaiController::class, 'import'])->name('import.excel');
    Route::post('/pegawai/renew/{id}/{tipe}', [PegawaiController::class, 'renew'])->name('pegawai.renew');
    Route::post('/pegawai/mutasi/{id}', [PegawaiController::class, 'pindahMutasi'])->name('pegawai.mutasi');
    Route::post('/pegawai/pensiun/{id}', [PegawaiController::class, 'pindahPensiun'])->name('pegawai.pensiun');
    Route::delete('/pegawai-delete-all', [PegawaiController::class, 'deleteAll'])->name('pegawai.deleteAll');
    
    // ROUTE HAPUS BANYAK (Diselaraskan dengan URL /admin/pegawai/bulk-delete yang dipanggil browser)
    Route::delete('/pegawai/bulk-delete', [PegawaiController::class, 'bulkDestroy'])->name('pegawai.bulkDestroy');
    Route::delete('/pegawai/hapus-banyak', [PegawaiController::class, 'bulkDestroy']);
    
    // --- FITUR KEMBALIKAN STATUS MUTASI & PENSIUN MASSAL ---
    Route::post('/mutasi/kembalikan-banyak', [MutasiController::class, 'bulkRestore'])->name('mutasi.bulkRestore');
    Route::post('/pensiun/kembalikan-banyak', [PensiunController::class, 'bulkRestore'])->name('pensiun.bulkRestore');
    
    // Jalur penampung upload berkas dokumen baru
    Route::post('/pegawai/dokumen/store', [PegawaiController::class, 'storeDokumen'])->name('pegawai.dokumen.store');
    
    // Halaman khusus untuk melihat/preview daftar berkas dokumen
    Route::get('/pegawai/{id}/berkas', [PegawaiController::class, 'lihatBerkas'])->name('pegawai.berkas');
    
    // Penyeimbang Rute Dinamis
    Route::get('/dokumen', function () {
        $id = request('pegawai_id');
        if (!$id) {
            abort(404);
        }
        return app()->call([app(PegawaiController::class), 'lihatBerkas'], ['id' => $id]);
    })->name('admin.dokumen.index');
    
    // Rute khusus preview & hapus dokumen
    Route::get('/pegawai/preview-dokumen/{id}', [PegawaiController::class, 'previewDokumen'])->name('dokumen.preview');
    Route::delete('/pegawai/hapus-dokumen/{id}', [PegawaiController::class, 'hapusDokumen'])->name('dokumen.destroy');
    
    // RESOURCE PEGAWAI (Diletakkan paling akhir dari grup pegawai)
    Route::resource('pegawai', PegawaiController::class)->except(['show']);

    Route::get('/setup-symlink', function () {
    $target = storage_path('app/public');
    $shortcut = public_path('storage');
    
    if (!file_exists($shortcut)) {
        symlink($target, $shortcut);
        return 'Symlink berhasil dibuat!';
    }
    
    return 'Symlink sudah ada!';
    });
});