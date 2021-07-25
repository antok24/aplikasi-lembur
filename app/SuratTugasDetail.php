<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratTugasDetail extends Model
{
    protected $table = 't_surat_tugas_detail';
    
    protected $fillable = [
        'kode_upbjj',
        'nomor_surat_tugas',
        'nip',
        'tanggal_kegiatan',
        'status',
        'user_create',
        'user_update'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'nip', 'nip');
    }
}
