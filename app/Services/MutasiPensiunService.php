<?php

namespace App\Services;

use App\Models\Pegawai;

class MutasiPensiunService
{
    /**
     * Memproses perpindahan pegawai ke status mutasi
     */
    public function prosesMutasi($id, $catatan = null, $tanggal = null)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->status = 'mutasi';
        $pegawai->catatan_status = $catatan; 
        
        // Menyimpan tanggal mutasi jika diisi, jika tidak tetap null (strip di tabel)
        $pegawai->tanggal_mutasi = $tanggal; 
        
        return $pegawai->save();
    }

    /**
     * Memproses perpindahan pegawai ke status pensiun
     */
    public function prosesPensiun($id, $catatan = null, $tanggal = null)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->status = 'pensiun';
        $pegawai->catatan_status = $catatan; // Menyimpan catatan pensiun
        
        // Menyimpan tanggal pensiun jika diisi, jika tidak tetap null (strip di tabel)
        $pegawai->tanggal_pensiun = $tanggal; 
        
        return $pegawai->save();
    }
}