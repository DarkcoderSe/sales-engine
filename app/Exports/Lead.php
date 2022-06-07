<?php

namespace App\Exports;

use Tu6ge\VoyagerExcel\Exports\AbstractExport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
// use App\Models\Lead as L;
use App\Models\CityAttraction;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Lead implements FromView, WithStyles, ShouldAutoSize
{
    // protected $dataType;
    // protected $model;
    public $leads;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($leads)
    {
        // $this->dataType = $dataType;
        // $this->model = new $dataType->model_name(); // this is current Model instance
        // $ids is user selected record ids
        // $this->leads = L::whereIn('id', $ids)->get();
        // $this->leads = L::today();
        $this->leads = $leads;
        // write your own idea
    }

    // public function collection()
    // {
    //     return $this->leads;
    // }

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
