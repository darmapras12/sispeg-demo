<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'pendidikans';

    protected $fillable = [
        'pegawai_id',
        'pendidikan_nama',
        'pendidikan_tahun',
        'pendidikan_ijazah',
    ];

    /**
     * Relasi: Pendidikan dimiliki oleh 1 Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}