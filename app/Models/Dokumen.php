<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'jenis_dokumen',
        'nama_file',
        'path_file',
    ];

    // Relasi balik ke Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}