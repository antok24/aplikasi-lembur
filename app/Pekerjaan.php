<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = 't_riwayat_pekerjaan';
    protected $fillable = ['nip','unit_kerja','jabatan','nomor_sk','waktu','keterangan','user_create','user_update'];
}
