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
                            <label>Event Duration</label>
                            <input type="number" name="event_duration" class="form-control" >

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
                            <input type="text" name="title" class="form-control" >

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
                            <label>Developer</label>
                            <select name="developer" class="custom-select">
                                @foreach ($developers as $developer)
                                <option value="{{ $developer->id }}">
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
                                <option value="{{ $profile->id }}">
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
                            <select name="cc_emails" class="custom-select" multiple>
                                @foreach ($users as $user)
                                <option value="{{ $user->email }}">{{ $user->email }}</option>
                                @endforeach
                            </select>

                            @if ($errors->any('cc_emails'))
                            <span class="small text-danger">
                                {{ $errors->first('cc_emails') }}
                            </span>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div

@endsection

