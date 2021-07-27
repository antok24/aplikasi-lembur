<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{    
   	protected $table = 't_lembur';
    protected $fillable = [
		'kode_upbjj',
		'nip',
		'id_surat_tugas_detail',
		'uraian_kegiatan',
		'satuan',
		'volume',
		'masuk',
		'pulang',
		'totaljam',
		'status_validasi',
		'kode_upbjj',
		'catatan_atasan',
		'user_create',
		'user_update'
	];
		
	public function user()
    {
        return $this->belongsTo('App\User', 'nip', 'nip');
    }

	public function surattugasdetail()
    {
        return $this->belongsTo('App\SuratTugasDetail', 'id_surat_tugas_detail', 'id');
    }
}