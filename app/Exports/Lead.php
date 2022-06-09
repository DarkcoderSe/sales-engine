<?php

namespace App\Exports;

use Tu6ge\VoyagerExcel\Exports\AbstractExport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\CityAttraction;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Lead implements FromView, WithStyles, ShouldAutoSize
{
    public $leads;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($leads)
    {
        $this->leads = $leads;
    }

    public function view(): View
    {
        $cityAttractions = CityAttraction::all();
        return view('exports.lead', [
            'leads' => $this->leads,
            'cityAttractions' => $cityAttractions
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
