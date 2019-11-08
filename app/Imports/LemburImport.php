<?php

namespace App\Imports;

use App\Lembur;
use Maatwebsite\Excel\Concerns\ToModel;

class LemburImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lembur([
            'id' => $row[0],
            'namapegawai' => $row[1],
            'nip' => $row[2],
            'nip_atasan' => $row[3],
            'tgl_lembur' => $row[4],
            'kegiatan' => $row[5],
            'uraiankegiatan' => $row[6],
            'satuan' => $row[7],
            'volume' => $row[8],
            'masuk' => $row[9],
            'pulang' => $row[10],
            'totaljam' => $row[11],
            'status' => $row[12],
            'kode_upbjj' => $row[13],
            'user_id' => $row[14]

        ]);
    }
}
