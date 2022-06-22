@extends('layouts.master')
@section('title', 'Edit Item - Sales Engine')
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
		<form action="{{ route('sales-engine.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="itemId" value="{{ $bdmLead->id }}">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Item Detail</h4>
					<p class="card-title-desc">Fill all information below</p>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Company Name <span class="text-danger">*</span></label>
								<input type="text" name="company_name" class="form-control" value="{{ $bdmLead->company_name }}"> @if ($errors->any('company_name')) <span class="text-danger small">
                                    {{ $errors->first('company_name') }}
                                </span> @endif </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Client Name <span class="text-danger">*</span></label>
								<input type="text" name="client_name" class="form-control" value="{{ $bdmLead->client_name }}"> @if ($errors->any('client_name')) <span class="text-danger small">
                                    {{ $errors->first('client_name') }}
                                </span> @endif </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Job Title <span class="text-danger">*</span></label>
								<input type="text" name="job_title" class="form-control" value="{{ $bdmLead->job_title }}"> @if ($errors->any('job_title')) <span class="text-danger small">
                                    {{ $errors->first('job_title') }}
                                </span> @endif </div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Job Source <span class="text-danger">*</span></label> <i class="fa fa-plus-circle addItem" data-toggle="modal" data-target="#addJobSource" aria-hidden="true"></i>
								<select aria-label="Default select example" name="job_source_id" class="form-control" required>
									@foreach ($jobSources as $jobSource)
                                    <option value="{{ $jobSource->id }}" {{ $bdmLead->job_source_id == $jobSource->id ? 'selected' : '' }}>
                                        {{ $jobSource->name }}
                                    </option>
                                    @endforeach
								</select>
                                @if ($errors->any('job_source_url'))
                                <span class="text-danger small">
                                    {{ $errors->first('job_source_url') }}
                                </span>
                                @endif
                            </div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>Job Source URL </label>
								<input type="text" name="job_source_url" class="form-control" value="{{ $bdmLead->job_source_url }}"> @if ($errors->any('job_source_url')) <span class="text-danger small">
                                    {{ $errors->first('job_source_url') }}
                                </span> @endif </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Profile <span class="text-danger">*</span></label> <i class="fa fa-plus-circle addItem" data-toggle="modal" data-target="#addProfile" aria-hidden="true"></i>
								<select aria-label="Default select example" name="profile_id" class="form-control" required>
                                    @foreach ($profiles as $profile)
                                    <option value="{{ $profile->id }}" {{ $bdmLead->profile_id == $profile->id ? 'selected' : '' }}>
                                        {{ $profile->name }}
                                    </option>
                                    @endforeach
								</select>
                                @if ($errors->any('profile_id'))
                                <span class="text-danger small">
                                    {{ $errors->first('profile_id') }}
                                </span>
                                @endif
                            </div>
						</div>
						<div class="col-md-6">
                            {{-- @dd($bdmLead->technologies) --}}
							<div class="form-group">
								<label>Technologies <span class="text-danger">*</span></label> <i class="fa fa-plus-circle addItem" data-toggle="modal" data-target="#addTechnology" aria-hidden="true"></i>
								<select aria-label="Default select example" name="technology_id" class="form-control" multiple required>
                                    @foreach ($technologies as $technology)
                                    <option value="{{ $technology->id }}"
                                        @if ($bdmLead->technologies)
                                            @php
                                                $selectTech = $bdmLead->technologies->where('technology_id', $technology->id)->first();
                                                if (!is_null($selectTech)) {
                                                    echo 'selected';
                                                }
                                            @endphp
                                        @endif>
                                        {{ $technology->name }}
                                    </option>
                                    @endforeach
								</select>
                                @if ($errors->any('technology_id'))
                                <span class="text-danger small">
                                    {{ $errors->first('technology_id') }}
                                </span>
                                @endif
                            </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Status <span class="text-danger">*</span></label>
								<select aria-label="Default select example" name="status" class="form-control">
									<option {{ $bdmLead->status == 0 ? 'selected' : '' }} value="0">Prospect</option>
                                    <option {{ $bdmLead->status == 1 ? 'selected' : '' }} value="1">Warm Lead</option>
									<option {{ $bdmLead->status == 2 ? 'selected' : '' }} value="2">Cold Lead</option>
									<option {{ $bdmLead->status == 3 ? 'selected' : '' }} value="3">Hired</option>
									<option {{ $bdmLead->status == 4 ? 'selected' : '' }} value="4">Rejected</option>

								</select>
                                @if ($errors->any('status'))
                                <span class="text-danger small">
                                    {{ $errors->first('status') }}
                                </span>
                                @endif
                            </div>
						</div>

                        <div class="col-md-6">
							<div class="form-group">
								<label>Phase <span class="text-danger">*</span></label>
								<select aria-label="Default select example" name="phase" class="form-control" value="{{ old('phase') }}">
									<option {{ $bdmLead->phase == 0 ? 'selected' : '' }} value="0">Prospect</option>
									<option {{ $bdmLead->phase == 1 ? 'selected' : '' }} value="1">Initial Correspondence</option>
									<option {{ $bdmLead->phase == 2 ? 'selected' : '' }} value="2">Follow-up</option>
									<option {{ $bdmLead->phase == 3 ? 'selected' : '' }} value="3">Pre-call Test</option>
									<option {{ $bdmLead->phase == 4 ? 'selected' : '' }} value="4">Post-call Test</option>
									<option {{ $bdmLead->phase == 5 ? 'selected' : '' }} value="5">1st Interview</option>
									<option {{ $bdmLead->phase == 6 ? 'selected' : '' }} value="6">2nd Interview</option>
									<option {{ $bdmLead->phase == 7 ? 'selected' : '' }} value="7">3rd Interview</option>
									<option {{ $bdmLead->phase == 8 ? 'selected' : '' }} value="8">4th Interview</option>
									<option {{ $bdmLead->phase == 9 ? 'selected' : '' }} value="9">Final Interview</option>
									<option {{ $bdmLead->phase == 10 ? 'selected' : '' }} value="10">Reference Check</option>
									<option {{ $bdmLead->phase == 11 ? 'selected' : '' }} value="11">Contract Awaited</option>
									<option {{ $bdmLead->phase == 12 ? 'selected' : '' }} value="12">Contract Recieved</option>
									<option {{ $bdmLead->phase == 13 ? 'selected' : '' }} value="13">Contract Signed & Sent</option>
									<option {{ $bdmLead->phase == 14 ? 'selected' : '' }} value="14">Hired</option>
									<option {{ $bdmLead->phase == 15 ? 'selected' : '' }} value="15">Rejected</option>
									<option {{ $bdmLead->phase == 16 ? 'selected' : '' }} value="16">Dormant</option>
								</select>
                                @if ($errors->any('phase'))
                                <span class="text-danger small">
                                    {{ $errors->first('phase') }}
                                </span>
                                @endif
                            </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Resume</label>
                                <input type="file" name="resume" class="form-control">
                                @if ($errors->any('resume'))
                                <span class="text-danger small">
                                    {{ $errors->first('resume') }}
                                </span>
                                @endif
                            </div>
						</div>
                        <div class="col-md-6">
							<div class="form-group">
								<label>Cover Letter</label>
                                <input type="file" name="cover_letter" class="form-control">
                                @if ($errors->any('cover_letter'))
                                <span class="text-danger small">
                                    {{ $errors->first('cover_letter') }}
                                </span>
                                @endif
                            </div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label>Job Description</label>
								<textarea type="text" name="job_description" class="form-control" rows="4">{{ $bdmLead->job_description }}</textarea>
                                @if ($errors->any('job_description'))
                                <span class="text-danger small">
                                    {{ $errors->first('job_description') }}
                                </span>
                                @endif
                            </div>
						</div>

                        <div class="col-md-6">
							<div class="form-group">
								<label>Notes</label>
								<textarea type="text" name="notes" class="form-control" rows="4">{{ $bdmLead->notes }}</textarea>
                                @if ($errors->any('notes'))
                                <span class="text-danger small">
                                    {{ $errors->first('notes') }}
                                </span>
                                @endif
                            </div>
						</div>
					</div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $bdmLead->email ?? old('email') }}">
                                @if ($errors->any('email'))
                                <span class="text-danger small">
                                    {{ $errors->first('email') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone_no" class="form-control" value="{{ $bdmLead->phone_no ?? old('phone_no') }}">
                                @if ($errors->any('phone_no'))
                                <span class="text-danger small">
                                    {{ $errors->first('phone_no') }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

					<h4 class="card-title mt-2">About Team</h4>
					<p class="card-title-desc">All Information below:</p>
					<div class="table-responsive">
                        <table class="table table-striped mb-0 table-bordered ">

                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Assigned To</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $developers = $developers->sortByDesc('id');
                                @endphp
                                @foreach ($developers as $developer)
                                <tr>
                                    <th  style="width:50px !important;">
                                        <input type="radio" name="developer" value="{{ $developer->id }}" {{ $bdmLead->developer->developer_id == $developer->id ? 'checked' : '' }}>
                                    </th>
                                    <td>{{ $developer->name }}</td>
                                    <td>{{ $developer->email ?? '' }}</td>
                                    <td>{{ $developer->phone_number ?? '' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>




			<div class="text-right mt-2 mb-4">
				<a href="{{ route('sales-engine.send.invite', $bdmLead->id) }}" class="btn btn-success waves-effect waves-light">Send an Invite</a>
				<button type="submit" class="btn btn-primary waves-effect waves-light">Update Item</button>
			</div>
	</div>
</div>
</form>


<!-- Modal -->
<div class="modal fade" id="addProfile" tabindex="-1" aria-labelledby="addProfileTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Profile</h5>
				<button type="button" class="close " data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<div class="modal-body">
                <form action="{{ route('profile.submit') }}" method="post">
                    @csrf
                    <div class="row justify-content-center no-gutters">
                        <div class="col-md-8 align-self-center">
                            <div class="form-group">
                                <label>Add Item </label>
                                <input type="text" name="profile_name" class="form-control addToListField">
                            </div>
                        </div>
                        <div class="col-md-2 align-self-center cstmSpaceBtn">
                            <button type="submit" class="btn btn-primary addToListBtn">Add</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addTechnology" tabindex="-1" aria-labelledby="addTechnologyTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Technology</h5>
				<button type="button" class="close " data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<div class="modal-body">
                <form action="{{ route('technology.submit') }}" method="post">
                    @csrf
                    <div class="row justify-content-center no-gutters">
                        <div class="col-md-8 align-self-center">
                            <div class="form-group">
                                <label>Add Item </label>
                                <input type="text" name="technology_name" class="form-control addToListField">
                            </div>
                        </div>
                        <div class="col-md-2 align-self-center cstmSpaceBtn">
                            <button type="submit" class="btn btn-primary addToListBtn">Add</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addJobSource" tabindex="-1" aria-labelledby="addJobSourceTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Job Source</h5>
				<button type="button" class="close " data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<div class="modal-body">
                <form action="{{ route('job-source.submit') }}" method="post">
                    @csrf
                    <div class="row justify-content-center no-gutters">
                        <div class="col-md-8 align-self-center">
                            <div class="form-group">
                                <label>Add Item </label>
                                <input type="text" name="job_source_name" class="form-control addToListField">
                            </div>
                        </div>
                        <div class="col-md-2 align-self-center cstmSpaceBtn">
                            <button type="submit" class="btn btn-primary addToListBtn">Add</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</div>


</div>
</div
@endsection
