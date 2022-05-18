<?php

namespace App\Exports;

use Tu6ge\VoyagerExcel\Exports\AbstractExport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Lead as L;

class Lead extends AbstractExport implements FromView
{
    protected $dataType;
    protected $model;
    public $leads;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($dataType, array $ids)
    {
        $this->dataType = $dataType;
        $this->model = new $dataType->model_name(); // this is current Model instance
        // $ids is user selected record ids
        $this->leads = L::whereIn('id', $ids)->get();
        // write your own idea
    }

    // public function collection()
    // {
    //     return $this->leads;
    // }

    public function view(): View
    {
        return view('exports.lead', [
            'leads' => $this->leads
        ]);
    }
}
