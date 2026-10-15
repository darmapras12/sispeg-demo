<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Diimport untuk fungsi relasi

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'nip',
        'tanggal_mutasi',
        'tanggal_pensiun',
        'nama_lengkap',
        'status',
        'catatan_status',
        'jabatan',
        'tmt_jabatan',
        'pangkat_golongan',
        'tmt_pangkat',
        'tmt_pangkat_terakhir',
        'tmt_kgb_terakhir',
        'next_kp',
        'next_kgb',
        'mk_tahun',
        'mk_bulan',
        'tanggal_lahir',
        'diklat_nama',
        'diklat_tahun',
        'diklat_durasi',
        'is_dashboard_only',
        'is_demo',
    ];

    protected $casts = [
        'tmt_pangkat' => 'date',
        'tmt_pangkat_terakhir' => 'date',
        'tmt_kgb_terakhir' => 'date',
        'next_kp' => 'date',
        'next_kgb' => 'date',
        'tanggal_lahir' => 'date',
        'is_dashboard_only' => 'boolean',
    ];

    /**
     * Relasi: 1 Pegawai memiliki banyak Pendidikan
     */
    public function pendidikans()
    {
        return $this->hasMany(Pendidikan::class, 'pegawai_id');
    }

    /**
     * Helper: Ambil diklat dalam bentuk array (karena disimpan format string pipa "|")
     */
    public function getDiklatNamaArrayAttribute()
    {
        return $this->diklat_nama && $this->diklat_nama !== '-'
            ? explode('|', $this->diklat_nama)
            : [];
    }

    public function getDiklatTahunArrayAttribute()
    {
        return $this->diklat_tahun && $this->diklat_tahun !== '-'
            ? explode('|', $this->diklat_tahun)
            : [];
    }

    public function getDiklatDurasiArrayAttribute()
    {
        return $this->diklat_durasi && $this->diklat_durasi !== '-'
            ? explode('|', $this->diklat_durasi)
            : [];
    }

    /**
     * Relasi: 1 Pegawai memiliki banyak Dokumen/Berkas Digital
     */
    public function dokumens(): HasMany
    {
        return $this->hasMany(Dokumen::class, 'pegawai_id');
    }
}