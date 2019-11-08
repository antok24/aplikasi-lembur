<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    public static $kode_upbjj;
    
   	protected $table = 'tlembur';
    protected $fillable = [
    		'namapegawai',
    		'nip',
            'nip_atasan',
    		'tgl_lembur',
    		'kegiatan',
            'uraiankegiatan',
            'satuan',
    		'volume',
    		'masuk',
    		'pulang',
            'totaljam',
            'status',
    		'kode_upbjj',
            'user_id'
    	];   
}