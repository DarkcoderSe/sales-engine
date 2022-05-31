<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BdmLead;
use App\Models\JobSource;
use App\Models\Profile;
use App\Models\Technology;
use App\Models\Developer;
use App\Models\BdmLeadDeveloper;
use App\Models\BdmLeadTechnology;
use App\Models\User;

use Carbon\Carbon;

use Toastr;

class SalesEngineController extends Controller
{
    public function create()
    {
        $jobSources = JobSource::all();
        $profiles = Profile::all();
        $technologies = Technology::all();
        $developers = Developer::all();

        return view('sales-engine.create')->with([
            'jobSources' => $jobSources,
            'profiles' => $profiles,
            'technologies' => $technologies,
            'developers' => $developers
        ]);
    }

    public function edit($leadId)
    {
        $jobSources = JobSource::all();
        $profiles = Profile::all();
        $technologies = Technology::all();
        $developers = Developer::all();
        $bdmLead = BdmLead::find($leadId);

        return view('sales-engine.edit')->with([
            'jobSources' => $jobSources,
            'profiles' => $profiles,
            'technologies' => $technologies,
            'developers' => $developers,
            'bdmLead' => $bdmLead
        ]);
    }

    public function search()
    {
        return view('sales-engine.search');
    }

    public function result(Request $request)
    {
        $query = $request->get('query');

        $bdmLeads = BdmLead::where('company_name', 'LIKE', "%{$query}%")->orderBy('created_at', 'DESC')->get();

        return view('sales-engine.result')->with([
            'bdmLeads' => $bdmLeads
        ]);
    }

    public function submit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'profile_id' => 'required|numeric',
            'technology_id' => 'required',
            'technology_id.*' => 'required|numeric',
            'job_source_id' => 'required|numeric',
            'company_name' => 'required|string',
            'client_name' => 'required|string',
            'job_title' => 'required|string',
            'status' => 'required|numeric',
            'resume' => 'nullable|string',
            'cover_letter' => 'nullable|string',
            'job_description' => 'nullable|string',
            'developer' => 'required|numeric',
            'job_source_url' => 'required|url'
        ]);

        $lead = new BdmLead;
        $lead->profile_id = $request->get('profile_id');
        // $lead->technology_id = $request->get('technology_id');
        $lead->job_source_id = $request->get('job_source_id');
        $lead->job_source_url = $request->get('job_source_url');
        $lead->company_name = $request->get('company_name');
        $lead->client_name = $request->get('client_name');
        $lead->job_title = $request->get('job_title');
        $lead->status = $request->get('status');
        $lead->status_changed = Carbon::now();
        $lead->phase = $request->get('phase');
        $lead->phase_changed_at = Carbon::now();
        $lead->resume = $request->get('resume');
        $lead->cover_letter = $request->get('cover_letter');
        $lead->job_description = $request->get('job_description');
        $lead->user_id = auth()->user()->id;
        $lead->save();

        $bdmLeadDeveloper = new BdmLeadDeveloper;
        $bdmLeadDeveloper->developer_id = $request->get('developer');
        $bdmLeadDeveloper->bdm_lead_id = $lead->id;
        $bdmLeadDeveloper->save();

        if (count($request->get('technology_id'))) {
            foreach ($request->get('technology_id') as $techId) {
                $leadTech = new BdmLeadTechnology;
                $leadTech->bdm_lead_id = $lead->id;
                $leadTech->technology_id = $techId;
                $leadTech->save();
            }
        }

        Toastr::success('Item has been added successfully');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'profile_id' => 'required|numeric',
            'technology_id' => 'required|numeric',
            'job_source_id' => 'required|numeric',
            'company_name' => 'required|string',
            'client_name' => 'required|string',
            'job_title' => 'required|string',
            'status' => 'required|numeric',
            'resume' => 'nullable|string',
            'cover_letter' => 'nullable|string',
            'job_description' => 'nullable|string',
            'developer' => 'required|numeric',
            'job_source_url' => 'required|url'
        ]);

        $lead = BdmLead::find($request->get('itemId'));
        $lead->profile_id = $request->get('profile_id');
        $lead->technology_id = $request->get('technology_id');
        $lead->job_source_id = $request->get('job_source_id');
        $lead->job_source_url = $request->get('job_source_url');
        $lead->company_name = $request->get('company_name');
        $lead->client_name = $request->get('client_name');
        $lead->job_title = $request->get('job_title');
        $lead->status = $request->get('status');
        $lead->status_changed = Carbon::now();
        $lead->phase = $request->get('phase');
        $lead->phase_changed_at = Carbon::now();
        $lead->resume = $request->get('resume');
        $lead->cover_letter = $request->get('cover_letter');
        $lead->job_description = $request->get('job_description');
        $lead->save();

        $bdmLeadDeveloper = BdmLeadDeveloper::where('bdm_lead_id', $lead->id)->delete();

        $bdmLeadDeveloper = new BdmLeadDeveloper;
        $bdmLeadDeveloper->developer_id = $request->get('developer');
        $bdmLeadDeveloper->bdm_lead_id = $lead->id;
        $bdmLeadDeveloper->save();

        Toastr::success('Item has been updated successfully');
        return redirect('sales-engine/search');
    }

    public function getJobSource()
    {
        $jobSources = JobSource::all();
        foreach ($jobSources as $key => $jobSource) {
            $job[$key]['id'] = $jobSource['id'];
            $job[$key]['name'] = $jobSource['name'];
        }
        return response()->json($job, 200);
    }

    public function getProfile()
    {
        $profiles = Profile::all();
        foreach ($profiles as $key => $profile) {
            $prof[$key]['id'] = $profile['id'];
            $prof[$key]['name'] = $profile['name'];
        }
        return response()->json($prof, 200);
    }

    public function getTechnology()
    {
        $technologies = Technology::all();
        foreach ($technologies as $key => $technology) {
            $tech[$key]['id'] = $technology['id'];
            $tech[$key]['name'] = $technology['name'];
        }
        return response()->json($tech, 200);
    }

    public function report(Request $request)
    {
        $profiles = Profile::all();
        $technologies = Technology::all();
        $developers = Developer::all();
        $jobSources = JobSource::all();
        $bdms = User::with('role')->whereHas('role', function($q) {
                                    return $q->where('name', 'bdm');
                                })
                                ->get();

        // $leads = collect([]);
        $query = $request->get('query');
        $from = $request->get('from');
        $to = $request->get('to');
        $profile = $request->get('profile');
        $technology = $request->get('technology');
        $phase = $request->get('phase');
        $status = $request->get('status');
        $bdm = $request->get('bdm');
        $jobSource = $request->get('jobSource');
        $developer = $request->get('developer');

        $leads = BdmLead::where('company_name', 'LIKE', "%{$query}%");
        // filters
        if (!is_null($from)) {
            $leads = $leads->where('created_at', '>', $from);
        }

        if (!is_null($to)) {
            $leads = $leads->where('created_at', '<', $to);
        }

        if ($profile != -1) {
            $leads = $leads->where('profile_id', $profile);
        }

        // dd($leads->take(10)->get());


        if ($phase != -1) {
            $leads = $leads->where('phase', $phase);
        }

        if ($status != -1) {
            $leads = $leads->where('status', $status);
        }

        if ($bdm != -1) {
            $leads = $leads->where('user_id', $bdm);
        }

        if ($jobSource != -1) {
            $leads = $leads->where('job_source_id', $jobSource);
        }




        $leads = $leads->orderBy('created_at', 'DESC')->paginate(30);

        return view('reports.report')->with([
            'profiles' => $profiles,
            'technologies' => $technologies,
            'developers' => $developers,
            'jobSources' => $jobSources,
            'bdms' => $bdms,
            'leads' => $leads
        ]);
    }

    public function searchReport(Request $request)
    {
        $leads= BdmLead::where('company_name', 'like', '%' . $request->search . '%')->with(['developer', 'technologies'])->get();
//         foreach ($leads as $key => $lead)
//         {
//             $lead['created_at']=Carbon::parse($lead->created_at)->format('Y-m-d');
//             $lead['agent']=User::select('name')->where('id',$lead->user_id)->first();
//             $lead['job_source']=JobSource::select('name')->where('id',$lead->job_source_id)->first();
//             $lead['profile']=Profile::select('name')->where('id',$lead->profile_id)->first();
//             $devLead=BdmLeadDeveloper::select('developer_id')->where('bdm_lead_id', $lead->id)->first();
//             $lead['developer']=Developer::select('name')->where('id',$devLead->developer_id)->first();

// //       dd($lead['agent']);
//         }


        return response()->json($leads, 200);

    }
}
