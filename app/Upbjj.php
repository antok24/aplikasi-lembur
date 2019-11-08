<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upbjj extends Model
{
    protected $table = 'mupbjj';
    protected $primaryKey = 'kode_upbjj';
    protected $fillable = ['kode_upbjj', 'nama_upbjj', 'alamat', 'no_telp'];
    protected $guarded = [];
}
