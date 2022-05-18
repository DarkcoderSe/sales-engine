<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JobSource;
use App\Models\Lead;
use App\Models\Profile;
use App\Models\Technology;

use Toastr;

use App\Traits\Organization;

class LeadController extends Controller
{
    use Organization;

    public function index()
    {
        return view('lead.index');
    }

    public function create()
    {
        $jobSources = JobSource::all();
        $profiles = Profile::all();
        $technologies = Technology::all();

        return view('lead.create')->with([
            'jobSources' => $jobSources,
            'profiles' => $profiles,
            'technologies' => $technologies
        ]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string',
            'job_title' => 'required|string',
            'job_source_url' => 'required|url',
            'contact_name' => 'required|string',
            'email' => 'required|email',
            'linkedin_profile' => 'required|url'
        ]);

        $lead = new Lead;
        $lead->company_name = $request->get('company_name');
        $lead->client_name = $request->get('client_name');
        $lead->job_title = $request->get('job_title');
        $lead->job_source_url = $request->get('job_source_url');
        $lead->contact_name = $request->get('contact_name');
        $lead->email = $request->get('email');
        $lead->linkedin_profile = $request->get('linkedin_profile');
        $lead->added_by = auth()->user()->id;
        $lead->save();

        try {
            $lead->headquater_address = $this->lookup($lead->company_name);
            $lead->save();
        } catch (\Throwable $th) {
            //throw $th;
        }

        Toastr::success('Lead added successfully');
        return redirect()->back();

    }

}
