<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Dokumen;
use App\Exports\PegawaiExport; 
use Maatwebsite\Excel\Facades\Excel;
use App\Services\PegawaiService; 
use App\Services\MutasiPensiunService; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    protected $pegawaiService;
    protected $mutasiPensiunService;

    public function __construct(PegawaiService $pegawaiService, MutasiPensiunService $mutasiPensiunService)
    {
        $this->pegawaiService = $pegawaiService;
        $this->mutasiPensiunService = $mutasiPensiunService;
    }

    /**
     * Helper: Pengecekan Apakah Data Tersebut Merupakan Data Master Milik Admin
     */
    private function isMasterData($pegawai)
    {
        // 1. Jika flag is_demo bernilai false/null/0, maka itu Data Master Admin
        if (!$pegawai->is_demo) {
            return true;
        }

        // 2. Pengecekan Spesifik berdasarkan NIP Master Admin
        $nipMaster = [
            '200207012025011001', // Darma Prastanto
            '199001012015031001', // Darma
            '198201012005031001', // Pras
            '197204121996031005', // Tanto
            '199203152018011004', // Tanto Mutasi
            '196811201994031001', // Darma P. Tjitrosatmo Pensiun
        ];

        return in_array($pegawai->nip, $nipMaster);
    }

    public function index(Request $request) {
        $tipeAktif = $request->query('tab', 'total'); 
        $batasAtas = Carbon::now()->addMonths(2)->endOfDay();

        $pegawaiKP = Pegawai::with(['pendidikans', 'dokumens'])
                            ->whereNull('status') 
                            ->whereNotNull('next_kp')
                            ->where('next_kp', '<=', $batasAtas)
                            ->orderBy('next_kp', 'asc')
                            ->get();
                            
        $pegawaiKGB = Pegawai::with(['pendidikans', 'dokumens'])
                             ->whereNull('status') 
                             ->whereNotNull('next_kgb')
                             ->where('next_kgb', '<=', $batasAtas)
                             ->orderBy('next_kgb', 'asc')
                             ->get();

        $semuaPegawai = Pegawai::with(['pendidikans', 'dokumens'])
                               ->whereNull('status')
                               ->orderBy('created_at', 'asc')
                               ->get();

        $dataTabel = match($tipeAktif) {
            'kp' => $pegawaiKP,
            'kgb' => $pegawaiKGB,
            default => $semuaPegawai
        };

        return view('monitoring', compact('semuaPegawai', 'pegawaiKP', 'pegawaiKGB', 'dataTabel', 'tipeAktif'));
    }

    /**
     * Menyimpan Data Pegawai Baru (Memastikan is_demo = true saat Guest menginput)
     */
    public function store(Request $request) {
        $request->validate([ 
            'nip' => 'nullable|unique:pegawais,nip', 
            'nama_lengkap' => 'nullable',
        ], ['nip.unique' => 'NIP sudah terdaftar di database.']);
        
        $data = $request->all();

        // Tandai tegas sebagai data demo jika di-inputkan oleh akun Guest
        if (Auth::check() && Auth::user()->email === 'guest@demo.com') {
            $data['is_demo'] = true;
        } else {
            $data['is_demo'] = false;
        }

        foreach(['tangal_lahir', 'tmt_pangkat_terakhir', 'tmt_kgb_terakhir', 'tmt_pangkat', 'tmt_jabatan', 'next_kp', 'next_kgb'] as $field) {
            if ($request->has($field) && $request->$field === '') {
                $data[$field] = null;
            }
        }

        foreach(['diklat_nama', 'diklat_tahun', 'diklat_durasi', 'pendidikan_nama', 'pendidikan_tahun', 'pendidikan_ijazah'] as $field) {
            if ($request->has($field) && is_array($request->$field)) {
                $filtered = array_filter($request->$field, fn($val) => !is_null($val) && $val !== '');
                $data[$field] = count($filtered) > 0 ? array_values($filtered) : null;
            }
        }

        $this->pegawaiService->simpanPegawai($data);
        return redirect()->route('dashboard')->with('success', 'Data pegawai berhasil disimpan!');
    }

    /**
     * Memperbarui Data Pegawai (Guest Dilarang Mengubah Data Master)
     */
    public function update(Request $request, $id) {
        $pegawai = Pegawai::findOrFail($id);

        // BLOKIR GUEST dari mengubah Data Master Admin
        if (Auth::check() && Auth::user()->email === 'guest@demo.com' && $this->isMasterData($pegawai)) {
            return back()->with('error', 'Data ini merupakan Data Master Admin dan bersifat permanen. Anda hanya dapat mengubah data yang Anda tambahkan sendiri!');
        }

        $request->validate([
            'nip' => 'nullable|unique:pegawais,nip,' . $id,
            'nama_lengkap' => 'nullable',
        ], ['nip.unique' => 'NIP sudah terdaftar di database oleh pegawai lain.']);

        $data = $request->all();
        $fieldsToNull = ['tanggal_lahir', 'tmt_pangkat_terakhir', 'tmt_kgb_terakhir', 'tmt_pangkat', 'tmt_jabatan', 'next_kp', 'next_kgb', 'pangkat_golongan', 'jabatan'];
        
        foreach($fieldsToNull as $field) {
            if (array_key_exists($field, $data) && ($data[$field] === '' || $data[$field] === null)) {
                $data[$field] = null;
            }
        }

        foreach(['diklat_nama', 'diklat_tahun', 'diklat_durasi', 'pendidikan_nama', 'pendidikan_tahun', 'pendidikan_ijazah'] as $field) {
            if ($request->has($field) && is_array($request->$field)) {
                $filtered = array_filter($request->$field, fn($val) => !is_null($val) && $val !== '');
                $data[$field] = count($filtered) > 0 ? array_values($filtered) : null;
            }
        }

        $this->pegawaiService->updatePegawai($id, $data);
        return back()->with('success', 'Data pegawai berhasil diperbarui!');
    }

    /**
     * Renew Jadwal KP/KGB (Guest Dilarang Mengubah Data Master)
     */
    public function renew(Request $request, $id, $tipe) {
        $pegawai = Pegawai::findOrFail($id);

        if (Auth::check() && Auth::user()->email === 'guest@demo.com' && $this->isMasterData($pegawai)) {
            return back()->with('error', 'Jadwal Data Master Demo bersifat permanen dan tidak dapat diperbarui oleh akun Guest!');
        }

        $now = Carbon::now();
        $batasFilter = $now->copy()->addMonth();

        if ($tipe === 'kp' && $pegawai->next_kp) {
            $target = Carbon::parse($pegawai->next_kp);
            while ($target <= $batasFilter) { $target->addYears(4); }
            $pegawai->tmt_pangkat_terakhir = $target->copy()->subYears(4);
            $pegawai->next_kp = $target;
            $pegawai->tmt_pangkat = $target;
        } elseif ($tipe === 'kgb' && $pegawai->next_kgb) {
            $target = Carbon::parse($pegawai->next_kgb);
            while ($target <= $batasFilter) { $target->addYears(2); }
            $pegawai->tmt_kgb_terakhir = $target->copy()->subYears(2);
            $pegawai->next_kgb = $target;
        }
        
        $pegawai->status = null; 
        $pegawai->save();
        
        $tabAktif = $request->input('tab_target', $tipe);
        return redirect()->route('dashboard', ['tab' => $tabAktif])->with('success', 'Jadwal ' . strtoupper($tipe) . ' berhasil diperbarui!');
    }

    /**
     * Memindahkan Pegawai ke Mutasi (Guest Dilarang Memutaskan Data Master)
     */
    public function pindahMutasi(Request $request, $id) {
        $pegawai = Pegawai::findOrFail($id);

        if (Auth::check() && Auth::user()->email === 'guest@demo.com' && $this->isMasterData($pegawai)) {
            return back()->with('error', 'Data Master Demo bersifat permanen dan tidak dapat dimutaskan oleh akun Guest!');
        }

        $pegawai->update(['status' => 'mutasi', 'tanggal_mutasi' => $request->tanggal_mutasi, 'catatan_status' => $request->catatan]);
        return back()->with('success', 'Pegawai berhasil dimutasi!');
    }

    /**
     * Memindahkan Pegawai ke Pensiun (Guest Dilarang Mempensiunkan Data Master)
     */
    public function pindahPensiun(Request $request, $id) {
        $pegawai = Pegawai::findOrFail($id);

        if (Auth::check() && Auth::user()->email === 'guest@demo.com' && $this->isMasterData($pegawai)) {
            return back()->with('error', 'Data Master Demo bersifat permanen dan tidak dapat dipensiunkan oleh akun Guest!');
        }

        $pegawai->update(['status' => 'pensiun', 'tanggal_pensiun' => $request->tanggal_pensiun, 'catatan_status' => $request->catatan]);
        return back()->with('success', 'Pegawai berhasil dipensiunkan!');
    }

    public function indexData() {
        $pegawais = Pegawai::with(['pendidikans', 'dokumens'])
            ->whereNull('status')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.pegawai.index_data', compact('pegawais'));
    }

    /**
     * Menghapus Data Pegawai Individu (Guest Dilarang Menghapus Data Master)
     */
    public function destroy($id) {
        $pegawai = Pegawai::findOrFail($id);

        if (Auth::check() && Auth::user()->email === 'guest@demo.com' && $this->isMasterData($pegawai)) {
            return back()->with('error', 'Data ini merupakan Data Master Admin dan bersifat permanen. Anda hanya dapat menghapus data yang Anda tambahkan sendiri!');
        }

        $this->pegawaiService->deletePegawai($id);
        return back()->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Menghapus Data Pegawai Massal (Guest Dilarang Menghapus Data Master)
     */
    public function bulkDestroy(Request $request) {
        $ids = $request->input('ids', $request->input('ids[]', []));
        
        if (empty($ids) || count($ids) === 0) {
            return back()->with('error', 'Pilih minimal satu data!');
        }

        if (Auth::check() && Auth::user()->email === 'guest@demo.com') {
            $pegawais = Pegawai::whereIn('id', $ids)->get();
            foreach ($pegawais as $p) {
                if ($this->isMasterData($p)) {
                    return back()->with('error', 'Data yang Anda pilih memuat Data Master Admin. Anda hanya dapat menghapus data yang Anda tambahkan sendiri!');
                }
            }
        }

        Pegawai::whereIn('id', $ids)->delete();
        return redirect()->route('dashboard')->with('success', 'Data pegawai terpilih berhasil dihapus!');
    }

    public function export(Request $request) {
        $namaFile = 'Rekap_Monitoring_' . date('d-m-Y') . '.xlsx';
        return Excel::download(new PegawaiExport($request->bulan, $request->tahun), $namaFile);
    }

    public function satya() {
        $pegawai = Pegawai::whereNull('status')->get();
        $dataSatya = $pegawai->map(function($p) {
            $nip = $p->nip;
            $hasil = ['pegawai' => $p, 'status_kelayakan' => 'NIP Tidak Valid', 'masa_kerja' => '-', 'class' => 'bg-danger text-white'];
            if (strlen($nip) >= 14) {
                $tmtRaw = substr($nip, 8, 6);
                $tahun = substr($tmtRaw, 0, 4); $bulan = substr($tmtRaw, 4, 2);
                try {
                    $startDate = Carbon::createFromDate($tahun, $bulan, 1)->startOfDay();
                    $cutoffDate = Carbon::createFromDate(2026, 8, 31)->endOfDay();
                    $diff = $startDate->diff($cutoffDate); $totalTahun = $diff->y;
                    if ($totalTahun >= 30) { $hasil['status_kelayakan'] = "30 TAHUN (EMAS)"; $hasil['class'] = "badge-emas"; }
                    elseif ($totalTahun >= 20) { $hasil['status_kelayakan'] = "20 TAHUN (PERAK)"; $hasil['class'] = "badge-perak"; }
                    elseif ($totalTahun >= 10) { $hasil['status_kelayakan'] = "10 TAHUN (PERUNGGU)"; $hasil['class'] = "badge-perunggu"; }
                    else { $hasil['status_kelayakan'] = "Belum Layak"; $hasil['class'] = "bg-light text-muted"; }
                    $hasil['masa_kerja'] = $totalTahun . " Thn " . $diff->m . " Bln";
                } catch (\Exception $e) {}
            }
            return (object)$hasil;
        });
        return view('admin.pegawai.satya', compact('dataSatya'));
    }

    public function storeDokumen(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'keterangan_dokumen' => 'required|string|max:255',
            'file_dokumen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $pegawai = Pegawai::findOrFail($request->pegawai_id);
        $file = $request->file('file_dokumen');

        $slugKeterangan = str_replace(' ', '_', $request->keterangan_dokumen);
        $namaFileBaru = ($pegawai->nip ?? 'tanpa_nip') . '_' . $slugKeterangan . '_' . time() . '.' . $file->getClientOriginalExtension();

        $file->move(storage_path('app/public/berkas_pegawai'), $namaFileBaru);

        Dokumen::create([
            'pegawai_id' => $pegawai->id,
            'jenis_dokumen' => $request->keterangan_dokumen,
            'nama_file' => $file->getClientOriginalName(),
            'path_file' => 'storage/berkas_pegawai/' . $namaFileBaru,
        ]);

        return back()->with('success', 'Berkas "' . $request->keterangan_dokumen . '" berhasil diupload untuk pegawai ' . $pegawai->nama_lengkap);
    }

    public function lihatBerkas($id)
    {
        $pegawai = Pegawai::with('dokumens')->findOrFail($id);
        return view('admin.pegawai.galeri_berkas.galeri_berkas', compact('pegawai'));
    }

    public function previewDokumen($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $cleanPath = str_replace('storage/', '', $dokumen->path_file);
        $pathAsli = storage_path('app/public/' . $cleanPath);

        if (!file_exists($pathAsli)) {
            abort(404, 'File dokumen tidak ditemukan di server.');
        }

        $mimeType = mime_content_type($pathAsli);

        return response()->file($pathAsli, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $dokumen->nama_file . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }

    public function hapusDokumen($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $cleanPath = str_replace('storage/', '', $dokumen->path_file);
        $pathAsli = storage_path('app/public/' . $cleanPath);

        if (file_exists($pathAsli)) {
            unlink($pathAsli);
        }

        $dokumen->delete();

        return back()->with('success', 'Berkas dokumen berhasil dihapus permanen!');
    }
}