<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusValidasi extends Model
{
    protected $table = 'm_statusverifikasi';
    protected $fillable = ['kode_verifikasi', 'status_verifikasi'];
}
