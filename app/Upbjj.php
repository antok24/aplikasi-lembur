<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upbjj extends Model
{
    protected $table = 'mupbjj';
    protected $primaryKey = 'kode_upbjj';
    protected $fillable = [
        'kode_upbjj',
        'nama_upbjj', 
        'alamat', 
        'no_telp',
        'header_1',
        'header_2',
        'header_3',
        'header_4',
    ];

    public function surattugas()
    {
        return $this->hasMany('App\SuratTugas', 'kode_upbjj', 'kode_upbjj');
    }

}
