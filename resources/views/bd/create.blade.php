@extends('layouts.master')

@section('title', 'Add new Lead')

@section('content')
<style> 
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #ced4da;
    /* width: 100% !important; */
    border-radius: 4px;
}
.has-search .searchfield {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}
</style>
<div class="row justify-content-center">
    <div class="col-10 col-md-10 pb-4 mb-4">

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
                                <select  aria-label="Default select example" name="job_source_url" class="form-control" value="{{ old('job_source_url') }}">
                                <option value="1">upwork.com</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                </select>
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
                                <label>Profile <span class="text-danger">*</span></label>
                                <select  aria-label="Default select example" name="contact_name" class="form-control" value="{{ old('contact_name') }}" required>
                                <option value="1" >aqeelkamboh</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                </select>
                                @if ($errors->any('contact_name'))
                                <span class="text-danger small">
                                    {{ $errors->first('contact_name') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Technologies <span class="text-danger">*</span></label>
                                <select  aria-label="Default select example" name="linkedin_profile" class="form-control" value="{{ old('linkedin_profile') }}">
                                <option value="1" >Project Manager</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                </select>
                                @if ($errors->any('linkedin_profile'))
                                <span class="text-danger small">
                                    {{ $errors->first('linkedin_profile') }}
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User Name <span class="text-danger">*</span></label>
                                <select  aria-label="Default select example" name="contact_name" class="form-control" value="{{ old('contact_name') }}">
                                <option value="1" >Imran Ahmad</option>
                                <option value="2">Kamboh</option>
                                <option value="3">Darkcoder</option>
                                </select>
                                @if ($errors->any('contact_name'))
                                <span class="text-danger small">
                                    {{ $errors->first('contact_name') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lead Stage <span class="text-danger">*</span></label>
                                <select  aria-label="Default select example" name="linkedin_profile" class="form-control" value="{{ old('linkedin_profile') }}">
                                <option value="1" >Prospect</option>
                                <option value="2">Prospect</option>
                                <option value="3">Darkcoder</option>
                                </select>
                                @if ($errors->any('linkedin_profile'))
                                <span class="text-danger small">
                                    {{ $errors->first('linkedin_profile') }}
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>

                        <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phase Effect Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" >
                                @if ($errors->any('contact_name'))
                                <span class="text-danger small">
                                    {{ $errors->first('contact_name') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Resume</label>
                                <textarea type="text" class="form-control" rows="1"> </textarea>
                                @if ($errors->any('linkedin_profile'))
                                <span class="text-danger small">
                                    {{ $errors->first('linkedin_profile') }}
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cover Letter</label>
                                <textarea type="text" class="form-control" rows="1"> </textarea>
                                @if ($errors->any('linkedin_profile'))
                                <span class="text-danger small">
                                    {{ $errors->first('linkedin_profile') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job Description</label>
                                <textarea type="text" class="form-control" rows="1"> </textarea>
                                @if ($errors->any('linkedin_profile'))
                                <span class="text-danger small">
                                    {{ $errors->first('linkedin_profile') }}
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>

                            <h5 class="">Reports Section:</h5>
                <div class="row">
                        <div class="col-md-6">   
                            <label>Serach</label>
                            <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control searchfield" placeholder="Type here....">
                        </div>    
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Date From </label>
                        <input type="date" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Date to </label>
                        <input type="date" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Profile </label>
                        <select  class="form-control" >
                            <option value="1" >Imran Ahmad</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Phase </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Status </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Technology </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>BD </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Job Source </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Assigned to </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                        <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label mt-1" for="flexSwitchCheckChecked">Filter leads based on historical data</label>
                        </div>
                        </div>
                    </div>
                      <div class="col-md-5">
                        <div class="form-group">
                        <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label mt-1" for="flexSwitchCheckChecked">Filter leads based on over due dates</label>
                        </div>
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
