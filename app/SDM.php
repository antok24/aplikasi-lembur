<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SDM extends Model
{
	protected $table = 't_riwayat_pengembangan_sdm';
	protected $fillable = ['nip','nama_kegiatan','waktu','pelatih','efektif','kabko','file','user_create','user_update'];
    
}
