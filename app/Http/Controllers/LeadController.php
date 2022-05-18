<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JobSource;
use App\Models\Lead;
use App\Models\Profile;
use App\Models\Technology;

class LeadController extends Controller
{
    public function index()
    {
        $leads = [];
        return view('lead.index')->with([
            'leads' => $leads
        ]);
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
            'client_name' => 'required|string',
            'job_title' => 'required|string',
            'phase' => 'required|numeric',
            'phase_effective_date' => 'required|date',
            'status' => 'required|numeric',
            'status_effective_date' => 'required|date',
            'job_source' => 'required|numeric',
            'job_source_url' => 'nullable|url',
            'profile' => 'required|numeric',
            'technology' => 'required|numeric',
            'BD' => 'nullable|string',
            'assgin_at' => 'nullable|date'
        ]);
    }

}
