<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $table = 't_pejabat';
    protected $fillable = [
        'kode_upbjj',
        'nip', 
        'kode_jabatan', 
        'status',
        'user_create',
        'user_update',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'nip', 'nip');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan', 'kode_jabatan', 'kode_jabatan');
    }
}
