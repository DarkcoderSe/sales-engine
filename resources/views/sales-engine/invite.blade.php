@extends('layouts.master')
@section('title', 'Send Invite - Sales Engine TD')
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

.modal-header {
	border-bottom: 0px !important;
	padding-bottom: 0px !important;
}

.modal-footer {
	border-bottom: 0px !important;
	border-top: 0px !important;
}

.modal-body {
	border-bottom: 0px !important;
}

.addItem:hover {
	cursor: pointer;
}

.addToListField {
	border-radius: 0px !important;
}

.addToListBtn {
	border-radius: 0px !important;
	/* margin-top:2px; */
}

.cstmSpaceBtn {
	margin-top: 11px;
}
</style>
<div class="row justify-content-center">
	<div class="col-10 col-md-10 pb-4 mb-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('sales-engine.submit.invite') }}" method="post">
                    @csrf
                    <input type="hidden" name="bdm_lead_id" value="{{ $bdmLead->id }}">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Event Start Date</label>
                            <input type="date" name="event_start_date" class="form-control" placeholder="Event Start Date">

                            @if ($errors->any('event_start_date'))
                            <span class="small text-danger">
                                {{ $errors->first('event_start_date') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-3">
                            <label>Event Start Time</label>
                            <input type="time" name="event_start_time" class="form-control" placeholder="Event Start Time">

                            @if ($errors->any('event_start_time'))
                            <span class="small text-danger">
                                {{ $errors->first('event_start_time') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-3">
                            <label>Event Timezone</label>
                            <select name="event_timezone" class="custom-select">
                                <option value="PKT">PKT</option>
                                <option value="EDT">EDT</option>
                                <option value="PDT">PDT</option>
                                <option value="MDT">MDT</option>

                            </select>

                            @if ($errors->any('event_timezone'))
                            <span class="small text-danger">
                                {{ $errors->first('event_timezone') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-3">
                            <label>Event Duration (mins)</label>
                            <input type="number" name="event_duration" value="{{ old('event_duration') ?? 30 }}" class="form-control" >

                            @if ($errors->any('event_duration'))
                            <span class="small text-danger">
                                {{ $errors->first('event_duration') }}
                            </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') ?? '1st Call - Interview Invite' }}">

                            @if ($errors->any('title'))
                            <span class="small text-danger">
                                {{ $errors->first('title') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" >

                            @if ($errors->any('location'))
                            <span class="small text-danger">
                                {{ $errors->first('location') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Developer (Invite to)</label>
                            <select name="developer" class="custom-select">
                                @foreach ($developers as $developer)
                                <option value="{{ $developer->id }}" {{ $bdmLead->developer->developer_id == $developer->id ? 'selected' : '' }}>
                                    {{ $developer->name }}
                                </option>
                                @endforeach
                            </select>

                            @if ($errors->any('developer'))
                            <span class="small text-danger">
                                {{ $errors->first('developer') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>Profile</label>
                            <select name="profile" class="custom-select">
                                @foreach ($profiles as $profile)
                                <option value="{{ $profile->id }}" {{ $bdmLead->profile_id == $profile->id ? 'selected' : '' }} >
                                    {{ $profile->name }}
                                </option>
                                @endforeach
                            </select>

                            @if ($errors->any('profile'))
                            <span class="small text-danger">
                                {{ $errors->first('profile') }}
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label>CC Emails</label>
                            <select name="cc_emails[]" class="custom-select" multiple>
                                @foreach ($users as $user)
                                <option value="{{ $user->email }}"
                                    @if ($user->email == 'kaleem@transdata.biz' || $user->email == 'imran.ahmed@transdata.biz')
                                    selected
                                    @endif
                                    >{{ $user->email }}</option>
                                @endforeach
                            </select>

                            @if ($errors->any('cc_emails'))
                            <span class="small text-danger">
                                {{ $errors->first('cc_emails') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Interview Mode</label>
                            <input type="text" name="interview_mode" class="form-control" >

                            @if ($errors->any('interview_mode'))
                            <span class="small text-danger">
                                {{ $errors->first('interview_mode') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Interview Link</label>
                            <input type="text" name="interview_link" class="form-control" >

                            @if ($errors->any('interview_link'))
                            <span class="small text-danger">
                                {{ $errors->first('interview_link') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-2">
                            <label>Salary Range</label>
                            <input type="text" name="salary_range" class="form-control" >

                            @if ($errors->any('salary_range'))
                            <span class="small text-danger">
                                {{ $errors->first('salary_range') }}
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Client Name</label>
                            <input type="text" name="client_name" class="form-control" value="{{ $bdmLead->client_name }}">

                            @if ($errors->any('client_name'))
                            <span class="small text-danger">
                                {{ $errors->first('client_name') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label>Client Organization</label>
                            <input type="text" name="client_organization" class="form-control" value="{{ $bdmLead->company_name }}">

                            @if ($errors->any('client_organization'))
                            <span class="small text-danger">
                                {{ $errors->first('client_organization') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label>Interview Person</label>
                            <input type="text" name="interview_person" class="form-control" >

                            @if ($errors->any('interview_person'))
                            <span class="small text-danger">
                                {{ $errors->first('interview_person') }}
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Job Board</label>
                            <input type="text" name="job_board" class="form-control" value="{{ $bdmLead->jobSource->name ?? '' }}">

                            @if ($errors->any('job_board'))
                            <span class="small text-danger">
                                {{ $errors->first('job_board') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label>Position</label>
                            <input type="text" name="position" class="form-control" value="{{ $bdmLead->job_title }}">

                            @if ($errors->any('position'))
                            <span class="small text-danger">
                                {{ $errors->first('position') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tech Stack</label>
                            <select name="tech[]" class="custom-select" multiple>
                                @foreach ($techs as $tech)
                                <option value="{{ $tech->id }}" {{ $bdmLead->technologies->where('technology_id', $tech->id)->count() > 0 ? 'selected' : '' }}>{{ $tech->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->any('tech'))
                            <span class="small text-danger">
                                {{ $errors->first('tech') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Job Description</label>
                            <textarea name="job_description" rows="4" class="form-control">{{ $bdmLead->job_description }}</textarea>

                            @if ($errors->any('job_description'))
                            <span class="small text-danger">
                                {{ $errors->first('job_description') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>Notes</label>
                            <textarea name="notes" rows="4" class="form-control"></textarea>

                            @if ($errors->any('notes'))
                            <span class="small text-danger">
                                {{ $errors->first('notes') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 text-right">
                            <button type="submit" class="btn btn-success">Send Invite</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div

@endsection

