<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    protected $table = 't_surat_tugas';
    
    protected $fillable = [
        'kode_upbjj',
        'nomor_surat_tugas',
        'nama_kegiatan',
        'tanggal_kegiatan',
        'status',
        'penanda_tangan',
        'user_create',
        'user_update'
    ];
}
