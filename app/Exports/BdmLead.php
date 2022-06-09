<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BdmLead implements FromView, WithStyles, ShouldAutoSize
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
        return view('exports.bdm-leads', [
            'leads' => $this->leads
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
