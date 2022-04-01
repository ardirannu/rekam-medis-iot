<?php

namespace App\Imports;

use App\Models\Nomor as ModelsNomor;
use App\Nomor;
use Maatwebsite\Excel\Concerns\ToModel;

class NomorImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ModelsNomor([
            'detail_nomor' => $row[1],
            'jumlah_digit' => $row[2], 
            'harga' => $row[3], 
            'operator' => $row[4], 
        ]);
    }
}
