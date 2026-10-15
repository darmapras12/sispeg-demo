<?php

namespace App\Services;

use App\Models\Pegawai;
use App\Models\Pendidikan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PegawaiService
{
    public function simpanPegawai(array $data)
    {
        return DB::transaction(function () use ($data) {
            $isMaster = !empty($data['jabatan']) || 
                        !empty($data['pangkat_golongan']) || 
                        !empty($data['pendidikan_nama']) || 
                        !empty($data['nip']) || 
                        !empty($data['tanggal_lahir']);

            $pegawai = Pegawai::create([
                'nip'                  => $data['nip'] ?? '-',
                'nama_lengkap'         => $data['nama_lengkap'] ?? '-',
                'jabatan'              => $data['jabatan'] ?? '-',
                'tmt_jabatan'          => $data['tmt_jabatan'] ?? null,
                'pangkat_golongan'     => $data['pangkat_golongan'] ?? '-',
                'tmt_pangkat'          => !empty($data['tmt_pangkat']) ? Carbon::parse($data['tmt_pangkat'])->addYears(4) : null, 
                'tmt_pangkat_terakhir' => $data['tmt_pangkat_monitoring'] ?? null,
                'tmt_kgb_terakhir'     => $data['tmt_kgb'] ?? null,
                'mk_tahun'             => $data['mk_tahun'] ?? 0,
                'mk_bulan'             => $data['mk_bulan'] ?? 0,
                'tanggal_lahir'        => $data['tanggal_lahir'] ?? null,
                
                'diklat_nama'          => $this->arrayToString($data['diklat_nama'] ?? null),
                'diklat_tahun'         => $this->arrayToString($data['diklat_tahun'] ?? null),
                'diklat_durasi'        => $this->arrayToString($data['diklat_durasi'] ?? null),
                
                'next_kp'              => !empty($data['tmt_pangkat_monitoring']) ? Carbon::parse($data['tmt_pangkat_monitoring'])->addYears(4) : null,
                'next_kgb'             => !empty($data['tmt_kgb']) ? Carbon::parse($data['tmt_kgb'])->addYears(2) : null,
                'is_dashboard_only'    => $isMaster ? 0 : 1,
                'is_demo'              => $data['is_demo'] ?? false, // Meneruskan penanda status guest demo
            ]);

            if (isset($data['pendidikan_nama']) && is_array($data['pendidikan_nama'])) {
                foreach ($data['pendidikan_nama'] as $key => $val) {
                    if (!empty($val)) {
                        $pegawai->pendidikans()->create([
                            'pendidikan_nama'   => $val,
                            'pendidikan_tahun'  => $data['pendidikan_tahun'][$key] ?? '-',
                            'pendidikan_ijazah' => $data['pendidikan_ijazah'][$key] ?? '-',
                        ]);
                    }
                }
            }

            return $pegawai;
        });
    }

    public function updatePegawai($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $p = Pegawai::findOrFail($id);
            
            $data['diklat_nama']   = $this->arrayToString($data['diklat_nama'] ?? null);
            $data['diklat_tahun']  = $this->arrayToString($data['diklat_tahun'] ?? null);
            $data['diklat_durasi'] = $this->arrayToString($data['diklat_durasi'] ?? null);

            if (array_key_exists('tmt_pangkat', $data)) {
                $p->tmt_pangkat = !empty($data['tmt_pangkat']) ? Carbon::parse($data['tmt_pangkat'])->addYears(4) : null;
            }

            if (array_key_exists('tmt_pangkat_monitoring', $data)) {
                $p->tmt_pangkat_terakhir = !empty($data['tmt_pangkat_monitoring']) ? $data['tmt_pangkat_monitoring'] : null;
                $p->next_kp = !empty($data['tmt_pangkat_monitoring']) ? Carbon::parse($data['tmt_pangkat_monitoring'])->addYears(4) : null;
            }

            if (array_key_exists('tmt_kgb', $data)) {
                $p->tmt_kgb_terakhir = !empty($data['tmt_kgb']) ? $data['tmt_kgb'] : null;
                $p->next_kgb = !empty($data['tmt_kgb']) ? Carbon::parse($data['tmt_kgb'])->addYears(2) : null;
            }

            $isMaster = !empty($data['jabatan']) || !empty($data['pangkat_golongan']) || !empty($data['nip']) || !empty($data['tanggal_lahir']);
            $p->is_dashboard_only = $isMaster ? 0 : 1;

            if (isset($data['pendidikan_nama']) && is_array($data['pendidikan_nama'])) {
                $p->pendidikans()->delete(); 
                foreach ($data['pendidikan_nama'] as $key => $val) {
                    if (!empty($val)) {
                        $p->pendidikans()->create([
                            'pendidikan_nama'   => $val,
                            'pendidikan_tahun'  => $data['pendidikan_tahun'][$key] ?? '-',
                            'pendidikan_ijazah' => $data['pendidikan_ijazah'][$key] ?? '-',
                        ]);
                    }
                }
            }

            unset($data['tmt_pangkat'], $data['tmt_pangkat_monitoring'], $data['tmt_kgb'], $data['pendidikan_nama'], $data['pendidikan_tahun'], $data['pendidikan_ijazah']);

            $p->fill($data);
            $p->save();

            return $p;
        });
    }

    private function arrayToString($input)
    {
        if (is_string($input) && $input !== '-' && $input !== '') {
            return $input;
        }

        if (is_array($input)) {
            $filtered = array_filter($input, function($val) {
                return !is_null($val) && $val !== '';
            });
            return count($filtered) > 0 ? implode('|', $filtered) : '-';
        }

        return '-';
    }

    public function deletePegawai($id) 
    { 
        return Pegawai::findOrFail($id)->delete(); 
    }
}