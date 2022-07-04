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

                    <div class="row">
                        <div class="col-md-6">

                            <h4 class="card-title">Item Detail</h4>
                            <p class="card-title-desc">Fill all information below</p>

                        </div>
                        <div class="col-md-6 text-right">
                            @auth
                            <h4 class="card-title">
                                Total Items Added: {{ auth()->user()->leads->count() ?? 0 }}

                            </h4>
                            @endauth
                        </div>
                    </div>


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
                                <label>Job Description <span class="text-danger">*</span></label>
                                <input type="text" name="job_description" class="form-control" value="{{ old('job_description') }}">

                                @if ($errors->any('job_description'))
                                <span class="text-danger small">
                                    {{ $errors->first('job_description') }}
                                </span>
                                @endif
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-6">
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
                                <label>Job Title <span class="text-danger">*</span></label>
                                <input type="text" name="job_title" class="form-control" value="{{ old('job_title') }}">

                                @if ($errors->any('job_title'))
                                <span class="text-danger small">
                                    {{ $errors->first('job_title') }}
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                {{-- Elixir, Flutter, React, Java, .NET etc --}}
                                <label>Job Type <span class="text-danger">*</span></label>
                                <select name="job_type" class="custom-select">
                                    <option value="full-stack">Full Stack</option>
                                    <option value="php">PHP</option>
                                    <option value="react-js">React JS</option>
                                    <option value="angular-js">Angular JS</option>
                                    <option value="node-js">Node JS</option>
                                    <option value="vue-js">Vue JS</option>
                                    <option value="ror">RoR</option>
                                    <option value="devops">DevOps</option>
                                    <option value="machine-learning">Machine Learning</option>
                                    <option value="blockchain">BlockChain</option>
                                    <option value="python">Python</option>
                                    <option value="elixir">Elixir</option>
                                    <option value="flutter">Flutter</option>
                                    <option value="react-native">React Native</option>
                                    <option value="java">Java</option>
                                    <option value="dot-net">.NET</option>
                                </select>

                                @if ($errors->any('job_type'))
                                <span class="text-danger small">
                                    {{ $errors->first('job_type') }}
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-8">
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
                                <label>Email Status <span class="text-danger">*</span></label>
                                <select name="email_status" class="custom-select">
                                    <option value="0">
                                        VALID
                                    </option>
                                    <option value="1">
                                        CATCHALL
                                    </option>
                                </select>

                                @if ($errors->any('email_status'))
                                <span class="text-danger small">
                                    {{ $errors->first('email_status') }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Job Class <span class="text-danger">*</span></label>
                                <select name="job_class" class="custom-select" required>
                                    <option value="full-time">
                                        Fulltime
                                    </option>
                                    <option value="contract">
                                        Contract
                                    </option>
                                </select>

                                @if ($errors->any('job_class'))
                                <span class="text-danger small">
                                    {{ $errors->first('job_class') }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="text-right mt-4 mb-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Item</button>
            </div>
        </form>


    </div>
</div

@endsection
