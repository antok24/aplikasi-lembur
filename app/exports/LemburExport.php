<?php

namespace App\Exports;

use App\Lembur;
use Maatwebsite\Excel\Concerns\FromCollection;

class LemburExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lembur::all();
    }
}
