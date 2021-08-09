<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'mjabatan';
    protected $fillable = [
        'kode_jabatan',
        'nama_jabatan',
    ];

    public function pejabat()
    {
        return $this->hasMany('App\Pejabat', 'kode_jabatan', 'kode_jabatan');
    }

}


