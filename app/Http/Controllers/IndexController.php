<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JobSource;
use App\Models\Profile;
use App\Models\Technology;

use Toastr;

class IndexController extends Controller
{
    public function jobSourceSubmit(Request $request)
    {
        $request->validate([
            'job_source_name' => 'required|string'
        ]);

        $jobSource = new JobSource;
        $jobSource->name = $request->get('job_source_name');
        $jobSource->save();

        Toastr::success('Job Source Added Successfully');
        return redirect()->back();
    }

    public function profileSubmit(Request $request)
    {
        $request->validate([
            'profile_name' => 'required|string'
        ]);

        $profile = new Profile;
        $profile->name = $request->get('profile_name');
        $profile->save();

        Toastr::success('Profile Added Successfully');
        return redirect()->back();
    }

    public function technologySubmit(Request $request)
    {
        $request->validate([
            'technology_name' => 'required|string'
        ]);

        $technology = new Technology;
        $technology->name = $request->get('technology_name');
        $technology->save();

        Toastr::success('Technology Added Successfully');
        return redirect()->back();
    }
}
