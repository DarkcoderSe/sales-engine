@extends('layouts.master')

@section('title', 'Add new Lead')

@section('content')
<div class="row justify-content-center">
    <div class="col-8 col-md-8 pb-4 mb-4">

        <form action="{{ URL::to('lead/submit') }}" method="post">
            @csrf

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Lead Detail</h4>
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
                                <label>Client Name <span class="text-danger">*</span></label>
                                <input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}">

                                @if ($errors->any('client_name'))
                                <span class="text-danger small">
                                    {{ $errors->first('client_name') }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
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
                        <div class="col-md-6">
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

                        <div class="col-md-6">
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

                        <div class="col-md-6">
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
