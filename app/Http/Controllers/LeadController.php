<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JobSource;
use App\Models\Lead;
use App\Models\Profile;
use App\Models\Technology;

use Toastr;

use App\Traits\Organization;
use DB;
use Carbon\Carbon;

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
            'linkedin_profile' => 'required|url',
            'company_linkedin_url' => 'required|url',
            'job_type' => 'required|string',
            'job_description' => 'required|string',
            'job_class' => 'required|string'
        ]);


        $dateNow = Carbon::now()->startOfDay();
        $leadCount = Lead::where('email', $request->get('email'))->where('created_at', '>', $dateNow)->count();
        if ($leadCount > 0) {
            Toastr::error('Lead already added');
            return redirect()->back();
        }

        $lead = new Lead;
        $lead->company_name = $request->get('company_name');
        $lead->client_name = $request->get('client_name');
        $lead->job_title = $request->get('job_title');
        $lead->job_source_url = $request->get('job_source_url');
        $lead->contact_name = $request->get('contact_name');
        $lead->email = $request->get('email');
        $lead->linkedin_profile = $request->get('linkedin_profile');
        $lead->company_linkedin_url = $request->get('company_linkedin_url');
        $lead->job_description = $request->get('job_description');
        $lead->email_status = $request->get('email_status');
        $lead->job_type = $request->get('job_type');
        $lead->job_class = $request->get('job_class');
        $lead->added_by = auth()->user()->id;
        $lead->save();

        try {
            // https://www.linkedin.com/company/transdata-international
            $url = explode('/', $lead->company_linkedin_url);
            $timeObj = $this->getTimezoneByZipcode($url[4] ?? '');
            $lead->headquater_address = $this->lookup($url[4] ?? '');
            $lead->timezone = $timeObj->source;
            $lead->save();


        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('Something went wrong!');
        }

        Toastr::success('Lead added successfully');
        return redirect()->back();

    }



}
