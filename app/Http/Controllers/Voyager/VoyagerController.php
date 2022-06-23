<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;
use TCG\Voyager\Facades\Voyager;

use App\Models\BdmLead;
use App\Models\User;

use Illuminate\Http\Request;

use Carbon\{CarbonPeriod, Carbon};

use DB;


class VoyagerController extends BaseVoyagerController
{
    public function index()
    {
        $request = request();
        $bdms = User::with('role')
            ->whereHas('role', function($q) {
                return $q->where('name', 'bdm');
            })->get();

        $bdmLeadBaseQuery = BdmLead::query();

        if (!is_null($request->get('from'))) {
            $bdmLeadBaseQuery = $bdmLeadBaseQuery->where('created_at', '>', $request->get('from'));
        }

        if (!is_null($request->get('to'))) {
            $bdmLeadBaseQuery = $bdmLeadBaseQuery->where('created_at', '<', $request->get('to'));
        }

        if (!is_null($request->get('bdm')) && $request->get('bdm') != -1) {
            $bdmLeadBaseQuery = $bdmLeadBaseQuery->where('user_id', $request->get('bdm'));
        }

        $period = $this->getDates($request->get('from') ?? Carbon::create('2022-05-21'), $request->get('to') ?? Carbon::now());
        $ct_total = [];
        $ct_hired = [];
        $ct_rejected = [];
        $ct_warmlead = [];


        // CHARTS TOTAL
        $_chartTotal = clone $bdmLeadBaseQuery;
        $_chartTotal = $_chartTotal->where('status', 0);
        $_chartTotal = $this->chartReadyLeads($_chartTotal);

        // CHARTS HIRED
        $_chartHired = clone $bdmLeadBaseQuery;
        $_chartHired = $_chartHired->where('status', 3);
        $_chartHired = $this->chartReadyLeads($_chartHired);

        // CHARTS WARMLEAD
        $_chartWarmLead = clone $bdmLeadBaseQuery;
        $_chartWarmLead = $_chartWarmLead->where('status', 1);
        $_chartWarmLead = $this->chartReadyLeads($_chartWarmLead);

        // CHARTS REJECTED
        $_chartRejected = clone $bdmLeadBaseQuery;
        $_chartRejected = $_chartRejected->where('status', 4);
        $_chartRejected = $this->chartReadyLeads($_chartRejected);

        $period = collect($period)->map(function($item){
            return Carbon::create($item)->format('Y-m-d');
        });

        foreach ($period as $key => $date) {

            $ct_total[$key] = $this->getLeads($_chartTotal, $date);
            $ct_hired[$key] = $this->getLeads($_chartHired, $date);
            $ct_rejected[$key] = $this->getLeads($_chartRejected, $date);
            $ct_warmlead[$key] = $this->getLeads($_chartWarmLead, $date);

        }

        $_totalBaseQuery = clone $bdmLeadBaseQuery;
        $_prospectBaseQuery = clone $bdmLeadBaseQuery;
        $_warmLeadBaseQuery = clone $bdmLeadBaseQuery;
        $_coldLeadBaseQuery = clone $bdmLeadBaseQuery;
        $_hiredBaseQuery = clone $bdmLeadBaseQuery;
        $_rejectedBaseQuery = clone $bdmLeadBaseQuery;

        $_countBdmLeads['total'] = $_totalBaseQuery->count();
        $_countBdmLeads['prospect'] = $_prospectBaseQuery->where('status', 0)->count();
        $_countBdmLeads['warmlead'] = $_warmLeadBaseQuery->where('status', 1)->count();
        $_countBdmLeads['coldlead'] = $_coldLeadBaseQuery->where('status', 2)->count();
        $_countBdmLeads['hired'] = $_hiredBaseQuery->where('status', 3)->count();
        $_countBdmLeads['rejected'] = $_rejectedBaseQuery->where('status', 4)->count();

        return Voyager::view('voyager::index')->with([
            '_countBdmLeads' => $_countBdmLeads,
            'bdms' => $bdms,
            'period' => $period,
            'ct_total' => $ct_total,
            'ct_hired' => $ct_hired,
            'ct_rejected' => $ct_rejected,
            'ct_warmlead' => $ct_warmlead
        ]);
    }

    public function chartReadyLeads($query)
    {
        return $query->where('created_at', '<=', \Carbon\Carbon::now())
                        ->groupBy('date')
                        ->get(array(
                            DB::raw('Date(created_at) as date'),
                            DB::raw('COUNT(*) as "leads"')
                        ));
    }

    public function getDates($from, $to)
    {
        $period = CarbonPeriod::create($from, $to);
        // Convert the period to an array of dates
        $period = $period->toArray();

        $dates = collect($period)
            ->filter(function($item) {
                if ($item->dayOfWeek !=0 && $item->dayOfWeek != 6) {
                    return $item;
                }
                else return false;
        });

        $dates = $dates->values()->all();
        // dd($dates);

        return $dates;
    }

    public function getLeads($query, $dt)
    {
        if ($query->where('date', $dt)->count() > 0) {
            return $query->where('date', $dt)->first()->leads ?? 0;
        }
        else {
            return 0;
        }
    }
}
