<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PensiunController extends Controller
{
    public function index()
    {
        // Mengambil data pegawai dengan status 'pensiun' beserta data berkas/dokumennya
        $pegawais = Pegawai::where('status', 'pensiun')->with('dokumens')->latest()->get(); 
        
        // PERBAIKAN: Tambahkan 'pegawai' di antara 'admin' dan 'pensiun'
        return view('admin.pegawai.pensiun.index', compact('pegawais'));
    }

    /**
     * Membatalkan status pensiun beberapa pegawai sekaligus (BARU)
     */
    public function bulkRestore(Request $request)
    {
        $ids = $request->ids;
        
        if (!$ids || count($ids) == 0) {
            return back()->with('error', 'Pilih minimal satu pegawai untuk dikembalikan!');
        }

        // Set status, tanggal_pensiun, dan catatan menjadi null kembali agar aktif di Dashboard
        Pegawai::whereIn('id', $ids)->update([
            'status' => null,
            'tanggal_pensiun' => null,
            'catatan_status' => null
        ]);

        return back()->with('success', 'Pegawai yang dipilih berhasil dikembalikan ke status Aktif!');
    }
}