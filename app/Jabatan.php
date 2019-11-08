<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'mjabatan';
    protected $fillable = ['kode_jabatan', 'nama_jabatan', 'kode_upbjj', 'level_akses'];

}


