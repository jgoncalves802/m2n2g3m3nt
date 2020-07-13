<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use App\Models\Corret;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CorretImports implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Corret([

        'name'              => $row['name'],
        'id_corretora'       => $row['id_corretora'],
    
        ]);
    }
}
