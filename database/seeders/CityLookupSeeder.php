<?php

namespace Database\Seeders;

use App\Imports\CityLookupImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Seeder;

class CityLookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new CityLookupImport, public_path('cities.xlsx'));
    }
}
