<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $table = 't_pejabat';
    protected $fillable = [
        'kode_upbjj',
        'nip', 
        'jabatan', 
        'status',
        'user_create',
        'user_update',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'nip', 'nip');
    }
}
