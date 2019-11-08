<?php

namespace App\Exports;

use App\Lembur;
use Maatwebsite\Excel\Concerns\FromQuery;

class LemburQueryExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(string $kode_upbjj)
    {
        $this->kode_upbjj = $kode_upbjj;
    }

    public function query()
    {
        return Lembur::query()->select('namapegawai','nip')->where('kode_upbjj', 'like', '%'.$this->kode_upbjj.'%');
    }
}
