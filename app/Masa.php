<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masa extends Model
{
    protected $table = 't_masa';
    protected $fillable = [
        'kode_upbjj',
        'masa',
        'status',
        'user_create',
        'user_update'
    ];
}
