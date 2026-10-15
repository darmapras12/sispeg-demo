<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PegawaiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Skip jika NIP kosong
        if (!isset($row['nip'])) {
            return null;
        }

        // Ubah Tanggal Excel ke Format Database
        $tmtPangkat = isset($row['tmt_pangkat']) ? Date::excelToDateTimeObject($row['tmt_pangkat']) : null;
        $tmtKgb     = isset($row['tmt_kgb']) ? Date::excelToDateTimeObject($row['tmt_kgb']) : null;

        // Hitung Otomatis (+4 Tahun & +2 Tahun)
        $nextKp  = $tmtPangkat ? Carbon::instance($tmtPangkat)->addYears(4) : null;
        $nextKgb = $tmtKgb ? Carbon::instance($tmtKgb)->addYears(2) : null;

        // Simpan Data (Update jika NIP ada, Buat Baru jika tidak)
        return Pegawai::updateOrCreate(
            ['nip' => $row['nip']], 
            [
                'nama_lengkap'         => $row['nama'],
                'jabatan'              => $row['jabatan'] ?? null,
                'pangkat_golongan'     => $row['golongan'] ?? null,
                'tmt_pangkat_terakhir' => $tmtPangkat,
                'tmt_kgb_terakhir'     => $tmtKgb,
                'next_kp'              => $nextKp,
                'next_kgb'             => $nextKgb,
            ]
        );
    }
}