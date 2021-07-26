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

    public function surattugasdetail()
    {
        return $this->hasMany('App\SuratTugasDetail', 'nomor_surat_tugas', 'nomor_surat_tugas');
    }

    public function upbjj()
    {
        return $this->belongsTo('App\Upbjj', 'kode_upbjj', 'kode_upbjj');
    }
}
