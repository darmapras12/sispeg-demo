<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index()
    {
        // Mengambil data pegawai yang statusnya 'mutasi' beserta data berkas/dokumennya
        $pegawais = Pegawai::where('status', 'mutasi')->with('dokumens')->latest()->get(); 
        
        // Sesuaikan dengan struktur folder kamu di resources/views/admin/pegawai/mutasi/index.blade.php
        return view('admin.pegawai.mutasi.index', compact('pegawais'));
    }

    /**
     * Membatalkan status mutasi beberapa pegawai sekaligus (BARU)
     */
    public function bulkRestore(Request $request)
    {
        $ids = $request->ids;
        
        if (!$ids || count($ids) == 0) {
            return back()->with('error', 'Pilih minimal satu pegawai untuk dikembalikan!');
        }

        // Set status, tanggal_mutasi, dan catatan menjadi null kembali agar aktif di Dashboard
        Pegawai::whereIn('id', $ids)->update([
            'status' => null,
            'tanggal_mutasi' => null,
            'catatan_status' => null
        ]);

        return back()->with('success', 'Pegawai yang dipilih berhasil dikembalikan ke status Aktif!');
    }
}