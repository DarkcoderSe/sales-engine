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
		<form action="{{ route('sales-engine.update') }}" method="post">
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
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Title <span class="text-danger">*</span></label>
								<input type="text" name="job_title" class="form-control" value="{{ $bdmLead->job_title }}"> @if ($errors->any('job_title')) <span class="text-danger small">
                                    {{ $errors->first('job_title') }}
                                </span> @endif </div>
						</div>
						<div class="col-md-6">
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
							<div class="form-group">
								<label>Technologies <span class="text-danger">*</span></label> <i class="fa fa-plus-circle addItem" data-toggle="modal" data-target="#addTechnology" aria-hidden="true"></i>
								<select aria-label="Default select example" name="technology_id" class="form-control" required>
                                    @foreach ($technologies as $technology)
                                    <option value="{{ $technology->id }}" {{ $bdmLead->technology_id == $technology->id ? 'selected' : '' }}>
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
						<div class="col-md-12">
							<div class="form-group">
								<label>Status <span class="text-danger">*</span></label>
								<select aria-label="Default select example" name="status" class="form-control">
									<option {{ $bdmLead->status == 0 ? 'selected' : '' }} value="0">Prospect</option>
									<option {{ $bdmLead->status == 1 ? 'selected' : '' }} value="1">Worm</option>
									<option {{ $bdmLead->status == 2 ? 'selected' : '' }} value="2">Hired</option>
								</select>
                                @if ($errors->any('status'))
                                <span class="text-danger small">
                                    {{ $errors->first('status') }}
                                </span>
                                @endif
                            </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Resume</label>
								<textarea type="text" class="form-control" name="resume" rows="4">{{ $bdmLead->resume }}</textarea>
                                @if ($errors->any('resume'))
                                <span class="text-danger small">
                                    {{ $errors->first('resume') }}
                                </span>
                                @endif
                            </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Cover Letter</label>
								<textarea type="text" name="cover_letter" class="form-control" rows="4">{{ $bdmLead->cover_letter }}</textarea>
                                @if ($errors->any('cover_letter'))
                                <span class="text-danger small">
                                    {{ $errors->first('cover_letter') }}
                                </span>
                                @endif
                            </div>
						</div>
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
					</div>

					<h4 class="card-title mt-2">About Team</h4>
					<p class="card-title-desc">All Information below:</p>
					<div class="table-responsive">
                        <table class="table table-striped mb-0 table-bordered ">

                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Assigned To</th>
                                    <th>Fit for</th>
                                    <th>PM</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($bd/mLead->developer) --}}
                                @foreach ($developers as $developer)
                                <tr>
                                    <th  style="width:50px !important;">
                                        <input type="radio" name="developer" value="{{ $developer->id }}" {{ $bdmLead->developer->developer_id == $developer->id ? 'checked' : '' }}>
                                    </th>
                                    <td>{{ $developer->name }}</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>

			<div class="text-right mt-2 mb-4">
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
