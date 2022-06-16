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
        $leads = collect($this->leads);
        $leads = $leads->map(function($item) {
            $name = explode(" ", $item['contact_name']);
            $fname = $name[0] ?? '';
            $lname = $name[1] ?? '';

            $cityAttraction = [];
            $address = explode(',', $item['headquater_address']);
            $city = trim($address[1]) ?? '';
            $state = $address[2] ?? '';
            $attractions = "";
            $timezone = "";

            $cta = CityAttraction::where('city', $city)->first();
            if (!is_null($cta)) {
                $attractions = $cta->attractions;
                $state = $cta->state;
            }

            return [
                'company_name' => $item['company_name'],
                'company_linkedin_url' => $item['company_linkedin_url'],
                'company_url' => $item['company_url'],
                'job_type' => $item['job_type'],
                'job_source_url' => $item['job_source_url'],
                'job_description' => $item['job_description'],
                'first_name' => $fname,
                'last_name' => $lname,
                'linkedin_profile' => $item['linkedin_profile'],
                'job_title' => $item['job_title'],
                'email' => $item['email'],
                'email_status' => ($item['email_status'] ? 'CATCHALL' : 'VALID'),
                'city' => $city,
                'state' => $state,
                'timezone' => $timezone,
                'attractions' => $attractions
            ];
        });

        // dd($leads);


        $cityAttractions = CityAttraction::all();
        return view('exports.lead', [
            'leads' => $leads,
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
