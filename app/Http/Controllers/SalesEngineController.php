<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BdmLead;
use App\Models\JobSource;
use App\Models\Profile;
use App\Models\Technology;
use App\Models\Developer;
use App\Models\BdmLeadDeveloper;

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

        $bdmLeads = BdmLead::where('company_name', 'LIKE', "%{$query}%")->get();

        return view('sales-engine.result')->with([
            'bdmLeads' => $bdmLeads
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'profile_id' => 'required|numeric',
            'technology_id' => 'required|numeric',
            'job_source_id' => 'required|numeric',
            'company_name' => 'required|string',
            'client_name' => 'required|string',
            'job_title' => 'required|string',
            // 'job_source_url' => 'required|url',
            'status' => 'required|numeric',
            'resume' => 'nullable|string',
            'cover_letter' => 'nullable|string',
            'job_description' => 'nullable|string',
            'developer' => 'required|numeric'
        ]);

        $lead = new BdmLead;
        $lead->profile_id = $request->get('profile_id');
        $lead->technology_id = $request->get('technology_id');
        $lead->job_source_id = $request->get('job_source_id');
        $lead->company_name = $request->get('company_name');
        $lead->client_name = $request->get('client_name');
        $lead->job_title = $request->get('job_title');
        // $lead->job_source_url = $request->get('job_source_url');
        $lead->status = $request->get('status');
        $lead->status_changed = Carbon::now();
        $lead->resume = $request->get('resume');
        $lead->cover_letter = $request->get('cover_letter');
        $lead->job_description = $request->get('job_description');
        $lead->user_id = auth()->user()->id;
        $lead->save();

        $bdmLeadDeveloper = new BdmLeadDeveloper;
        $bdmLeadDeveloper->developer_id = $request->get('developer');
        $bdmLeadDeveloper->bdm_lead_id = $lead->id;
        $bdmLeadDeveloper->save();

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
            'developer' => 'required|numeric'
        ]);

        $lead = BdmLead::find($request->get('itemId'));
        $lead->profile_id = $request->get('profile_id');
        $lead->technology_id = $request->get('technology_id');
        $lead->job_source_id = $request->get('job_source_id');
        $lead->company_name = $request->get('company_name');
        $lead->client_name = $request->get('client_name');
        $lead->job_title = $request->get('job_title');
        $lead->status = $request->get('status');
        $lead->status_changed = Carbon::now();
        $lead->resume = $request->get('resume');
        $lead->cover_letter = $request->get('cover_letter');
        $lead->job_description = $request->get('job_description');
        $lead->save();

        $bdmLeadDeveloper = BdmLeadDeveloper::where('bdm_lead_id', $lead->id)->delete();

        $bdmLeadDeveloper = new BdmLeadDeveloper;
        $bdmLeadDeveloper->developer_id = $request->get('developer');
        $bdmLeadDeveloper->bdm_lead_id = $lead->id;
        $bdmLeadDeveloper->save();

        Toastr::success('Item has been added successfully');
        return redirect()->back();
    }
}
