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
use App\Models\InterviewInvite as InterviewModel;

use Illuminate\Support\Facades\Mail;
use App\Mail\InterviewInvite;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BdmLead as BdmLeadExport;

use Carbon\Carbon;

use Toastr;

use Illuminate\Support\Facades\Storage;

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

        $bdmLeads = BdmLead::where('company_name', 'LIKE', "%{$query}%")
                            ->orWhere('job_title', 'LIKE', "%{$query}%")
                            ->orderBy('created_at', 'DESC')->with('techs')->limit(30)->get();

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
            'resume' => 'nullable|mimes:pdf,docx',
            'cover_letter' => 'nullable|mimes:pdf,docx',
            'job_description' => 'nullable|string',
            'developer' => 'required|numeric',
            'job_source_url' => 'nullable|url',
            'email' => 'email|nullable',
            'phone_no' => 'string|nullable'
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
        $lead->phone_no = $request->get('phone_no');
        $lead->email = $request->get('email');
        // $lead->resume = $request->get('resume');
        // $lead->cover_letter = $request->get('cover_letter');
        $lead->notes = $request->get('notes');
        $lead->job_description = $request->get('job_description');
        if ($request->hasFile('resume')) {

            $file = $request->file('resume');
            $name = time() . $file->getClientOriginalName();
            $destinationPath = public_path('storage/resumes');
            $file->move($destinationPath, $name);
            $lead->resume = "resumes/{$name}";
        }

        if ($request->hasFile('cover_letter')) {

            $file = $request->file('cover_letter');
            $name = time() . $file->getClientOriginalName();
            $destinationPath = public_path('storage/cover-letters');
            $file->move($destinationPath, $name);
            $lead->cover_letter = "cover-letters/{$name}";
        }


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
            'resume' => 'nullable|mimes:pdf,docx',
            'cover_letter' => 'nullable|mimes:pdf,docx',
            'job_description' => 'nullable|string',
            'developer' => 'required|numeric',
            'job_source_url' => 'nullable|url',
            'email' => 'email|nullable',
            'phone_no' => 'string|nullable'
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
        $lead->notes = $request->get('notes');
        $lead->phase_changed_at = Carbon::now();
        $lead->phone_no = $request->get('phone_no');
        $lead->email = $request->get('email');
        // $lead->resume = $request->get('resume');
        // $lead->cover_letter = $request->get('cover_letter');
        if ($request->hasFile('resume')) {

            $file = $request->file('resume');
            $name = time() . $file->getClientOriginalName();
            $destinationPath = public_path('storage/resumes');
            $file->move($destinationPath, $name);
            $lead->resume = "resumes/{$name}";
        }

        if ($request->hasFile('cover_letter')) {

            $file = $request->file('cover_letter');
            $name = time() . $file->getClientOriginalName();
            $destinationPath = public_path('storage/cover-letters');
            $file->move($destinationPath, $name);
            $lead->cover_letter = "cover-letters/{$name}";
        }

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

        // dd($request->all());

        // $leads = collect([]);
        $query = $request->get('query');
        $from = $request->get('from');
        $to = $request->get('to');
        $profile = $request->get('profile');
        $technology = $request->get('technology');
        $phase = $request->get('phase');
        $status = $request->get('status');
        $bdm = $request->get('bdm') ?? [];
        $jobSource = $request->get('job_source');
        $developer = $request->get('developer');
        $lead_type = $request->get('lead_type') ?? '-1';

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

        if ($phase != -1) {
            $leads = $leads->where('phase', $phase);
        }

        if ($status != -1) {
            $leads = $leads->where('status', $status);
        }

        if (count($bdm) > 0) {
            $leads = $leads->whereIn('user_id', $bdm);
        }

        if ($jobSource != -1) {
            $leads = $leads->where('job_source_id', $jobSource);
        }

        if ($technology != -1) {
            $leads = $leads->with(['technologies', 'techs'])->whereHas('technologies', function ($q) use ($technology) {
                return $q->where('technology_id', $technology);
            });
        }

        if ($developer != -1) {
            $leads = $leads->with('developer')->whereHas('developer', function ($q) use ($developer) {
                return $q->where('developer_id', $developer);
            });
        }

        if ($lead_type != -1) {
            $leads = $leads->whereHas('jobSource', function ($q) use ($lead_type) {
                return $q->where('type', $lead_type);
            });
        }



        if ($request->get('export') == true) {
            $leads = $leads->orderBy('created_at', 'DESC')->get();
            $date = Carbon::now();
            return Excel::download(new BdmLeadExport($leads), "bdm-leads-{$date}.xlsx");
        }

        $totalLeads = $leads->count();
        $leads = $leads->orderBy('created_at', 'DESC')->paginate(30);

        return view('reports.report')->with([
            'profiles' => $profiles,
            'technologies' => $technologies,
            'developers' => $developers,
            'jobSources' => $jobSources,
            'bdms' => $bdms,
            'leads' => $leads,
            'totalLeads' => $totalLeads
        ]);
    }

    public function sendEmailInvite($leadId)
    {

        $developers = Developer::all();
        $profiles = Profile::all();
        $bdmLead = BdmLead::find($leadId);
        $techs = Technology::all();

        $int = InterviewModel::where('bdm_lead_id', $leadId)->get()->last();
        // dd($int);

        $users = User::with('role')
                ->whereHas('role', function($q) {
                    return $q->whereIn('name', ['super-admin', 'bdm']);
                })->get();

        return view('sales-engine.invite')->with([
            'bdmLead' => $bdmLead,
            'developers' => $developers,
            'profiles' => $profiles,
            'users' => $users,
            'techs' => $techs,
            'int' => $int
        ]);
    }

    public function submitEmailInvite(Request $request)
    {
        // dd($request->all());
        try {

            $dev = Developer::findOrFail($request->get('developer'));

            $bdPersonEmail = auth()->user()->email;


            $interview = new InterviewModel;
            $interview->event_start_at = "{$request->get('event_start_date')} {$request->get('event_start_time')}";
            $interview->event_timezone = $request->get('event_timezone');
            $interview->event_duration = $request->get('event_duration');
            $interview->title = $request->get('title');
            $interview->location = $request->get('location');
            $interview->interview_mode = $request->get('interview_mode');
            $interview->interview_link = $request->get('interview_link');
            $interview->client_name = $request->get('client_name');
            $interview->client_organization = $request->get('client_organization');
            $interview->position = $request->get('position');
            $interview->salary_range = $request->get('salary_range');
            $interview->notes = $request->get('notes');
            $interview->receiver_id = $dev->id;
            $interview->profile_id = $request->get('profile');
            $interview->sender_id = auth()->user()->id;
            $interview->bdm_lead_id = $request->get('bdm_lead_id');
            $interview->save();

            if ($dev->name != 'BD Team' && !is_null($dev->email)) {

                Mail::to($dev->email)
                    ->cc($request->get('cc_emails'))
                    ->queue(new InterviewInvite($bdPersonEmail, $interview));
            }

        } catch (\Throwable $th) {
            // dd($th);
            Toastr::error('Email Invitation failed due to some error!');
        }

        Toastr::success("Invite for Interview has been sent to user");
        return redirect()->back();

    }

}
