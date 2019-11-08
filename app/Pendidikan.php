<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $table = 't_riwayat_pendidikan';
    protected $fillable = ['nip','jenjang','pendidikan','tahun','efektif','kabko','user_create','user_update'];
}
