@extends('layouts.master')

@section('title', 'Add new Lead')

@section('content')
<div class="row justify-content-center">
    <div class="col-8 col-md-8 pb-4 mb-4">

                                            <!-- Modal -->
        <div class="modal fade" id="addJobSource" tabindex="-1" role="dialog" aria-labelledby="addJobSourceTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ URL::to('lead/job-source/submit') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <input type="text" class="form-control" name="job_source_name" placeholder="Job Source">
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <form action="{{ URL::to('lead/submit') }}" method="post">
            @csrf

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Item Detail</h4>
                    <p class="card-title-desc">Fill all information below</p>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name <span class="text-danger">*</span></label>
                                <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}">

                                @if ($errors->any('company_name'))
                                <span class="text-danger small">
                                    {{ $errors->first('company_name') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job Title <span class="text-danger">*</span></label>
                                <input type="text" name="job_title" class="form-control" value="{{ old('job_title') }}">

                                @if ($errors->any('job_title'))
                                <span class="text-danger small">
                                    {{ $errors->first('job_title') }}
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Company LinkedIn URL<span class="text-danger">*</span></label>
                                <input type="text" name="company_linkedin_url" class="form-control" value="{{ old('company_linkedin_url') }}">

                                @if ($errors->any('company_linkedin_url'))
                                <span class="text-danger small">
                                    {{ $errors->first('company_linkedin_url') }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Job Source <span class="text-danger">*</span> &nbsp;
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#addJobSource">
                                        <i class="fa-solid fa-square-plus"></i>
                                    </a>

                                </label>
                                <select name="job_source" class="custom-select">
                                    @foreach ($jobSources as $jobSource)
                                    <option value="{{ $jobSource->id }}">
                                        {{ $jobSource->name }}
                                    </option>
                                    @endforeach
                                </select>

                                @if ($errors->any('job_source'))
                                <span class="text-danger small">
                                    {{ $errors->first('job_source') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Job Source URL <span class="text-danger">*</span></label>
                                <input type="text" name="job_source_url" class="form-control" value="{{ old('job_source_url') }}">

                                @if ($errors->any('job_source_url'))
                                <span class="text-danger small">
                                    {{ $errors->first('job_source_url') }}
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact Name <span class="text-danger">*</span></label>
                                <input type="text" name="contact_name" class="form-control" value="{{ old('contact_name') }}">

                                @if ($errors->any('contact_name'))
                                <span class="text-danger small">
                                    {{ $errors->first('contact_name') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">

                                @if ($errors->any('email'))
                                <span class="text-danger small">
                                    {{ $errors->first('email') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>LinkedIn Profile <span class="text-danger">*</span></label>
                                <input type="text" name="linkedin_profile" class="form-control" value="{{ old('linkedin_profile') }}">

                                @if ($errors->any('linkedin_profile'))
                                <span class="text-danger small">
                                    {{ $errors->first('linkedin_profile') }}
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>



                </div>
            </div>


            <div class="text-right mt-4 mb-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Lead</button>
            </div>
        </form>


    </div>
</div

@endsection
