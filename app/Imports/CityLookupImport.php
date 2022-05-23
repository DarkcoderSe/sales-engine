<?php

namespace App\Imports;

use App\Models\CityAttraction;
use Maatwebsite\Excel\Concerns\ToModel;

class CityLookupImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $ctiyState = explode(',', $row[0]);
        return new CityAttraction([
            'city' => trim($ctiyState[0] ?? ''),
            'state' => trim($ctiyState[1] ?? ''),
            'attractions' => trim($row[1] ?? '')
        ]);
    }
}
