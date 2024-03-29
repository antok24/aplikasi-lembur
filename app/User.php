<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'nip','name', 'nip_atasan', 'group', 'status', 'email', 'password','kode_upbjj',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function surattugasdetail()
    {
        return $this->hasMany('App\SuratTugasDetail', 'nip', 'nip');
    }

    public function lembur()
    {
        return $this->hasMany('App\Lembur', 'nip', 'nip');
    }

    public function pejabat()
    {
        return $this->hasMany('App\Pejabat', 'nip', 'nip');
    }

    
}
