@extends('layouts.master')
@section('title', 'Add new Item')
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
		<form action="{{ URL::to('lead/submit') }}" method="post"> @csrf
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Lead Detail</h4>
					<p class="card-title-desc">Fill all information below</p>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Company Name <span class="text-danger">*</span></label>
								<input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}"> @if ($errors->any('company_name')) <span class="text-danger small">
                                    {{ $errors->first('company_name') }}
                                </span> @endif </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Client Name <span class="text-danger">*</span></label>
								<input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}"> @if ($errors->any('client_name')) <span class="text-danger small">
                                    {{ $errors->first('client_name') }}
                                </span> @endif </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Title <span class="text-danger">*</span></label>
								<input type="text" name="job_title" class="form-control" value="{{ old('job_title') }}"> @if ($errors->any('job_title')) <span class="text-danger small">
                                    {{ $errors->first('job_title') }}
                                </span> @endif </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Source URL <span class="text-danger">*</span></label> <i class="fa fa-plus-circle addItem" data-toggle="modal" data-target="#exampleModal" aria-hidden="true"></i>
								<select aria-label="Default select example" name="job_source_url" class="form-control" value="{{ old('job_source_url') }}">
									<option value="1">upwork.com</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select> @if ($errors->any('job_source_url')) <span class="text-danger small">
                                    {{ $errors->first('job_source_url') }}
                                </span> @endif </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Profile <span class="text-danger">*</span></label> <i class="fa fa-plus-circle addItem" data-toggle="modal" data-target="#exampleModal" aria-hidden="true"></i>
								<select aria-label="Default select example" name="contact_name" class="form-control" value="{{ old('contact_name') }}" required>
									<option value="1">aqeelkamboh</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select> @if ($errors->any('contact_name')) <span class="text-danger small">
                                    {{ $errors->first('contact_name') }}
                                </span> @endif </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Technologies <span class="text-danger">*</span></label> <i class="fa fa-plus-circle addItem" data-toggle="modal" data-target="#exampleModal" aria-hidden="true"></i>
								<select aria-label="Default select example" name="linkedin_profile" class="form-control" value="{{ old('linkedin_profile') }}">
									<option value="1">Project Manager</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select> @if ($errors->any('linkedin_profile')) <span class="text-danger small">
                                    {{ $errors->first('linkedin_profile') }}
                                </span> @endif </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>User Name <span class="text-danger">*</span></label>
								<select aria-label="Default select example" name="contact_name" class="form-control" value="{{ old('contact_name') }}">
									<option value="1">Imran Ahmad</option>
									<option value="2">Kamboh</option>
									<option value="3">Darkcoder</option>
								</select> @if ($errors->any('contact_name')) <span class="text-danger small">
                                    {{ $errors->first('contact_name') }}
                                </span> @endif </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Lead Stage <span class="text-danger">*</span></label>
								<select aria-label="Default select example" name="linkedin_profile" class="form-control" value="{{ old('linkedin_profile') }}">
									<option value="1">Prospect</option>
									<option value="2">Prospect</option>
									<option value="3">Darkcoder</option>
								</select> @if ($errors->any('linkedin_profile')) <span class="text-danger small">
                                    {{ $errors->first('linkedin_profile') }}
                                </span> @endif </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Phase Effect Date <span class="text-danger">*</span></label>
								<input type="date" class="form-control"> @if ($errors->any('contact_name')) <span class="text-danger small">
                                    {{ $errors->first('contact_name') }}
                                </span> @endif </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Resume</label>
								<textarea type="text" class="form-control" rows="1"> </textarea> @if ($errors->any('linkedin_profile')) <span class="text-danger small">
                                    {{ $errors->first('linkedin_profile') }}
                                </span> @endif </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Cover Letter</label>
								<textarea type="text" class="form-control" rows="1"> </textarea> @if ($errors->any('linkedin_profile')) <span class="text-danger small">
                                    {{ $errors->first('linkedin_profile') }}
                                </span> @endif </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Job Description</label>
								<textarea type="text" class="form-control" rows="1"> </textarea> @if ($errors->any('linkedin_profile')) <span class="text-danger small">
                                    {{ $errors->first('linkedin_profile') }}
                                </span> @endif </div>
						</div>
					</div>
					<h4 class="card-title mt-2">About Team</h4>
					<p class="card-title-desc">all information below</p>
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
                                                    <tr>
                                                        <th  style="width:50px !important;">
															<input type="radio" >
														</th>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                        <th ><input type="radio" ></th>
                                                        <td>Jacob</td>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                        <th ><input type="radio" ></th>
                                                        <td>Larry</td>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

				</div>

			</div>
			<div class="text-right mt-2 mb-4">
						<button type="submit" class="btn btn-primary waves-effect waves-light">Add Lead</button>
					</div>
	</div>
</div>
</form>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Items to List</h5>
				<button type="button" class="close " data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<div class="modal-body">
				<div class="row justify-content-center no-gutters">
					<div class="col-md-8 align-self-center">
						<div class="form-group">
							<label>Add Items: </label>
							<input type="text" class="form-control addToListField"> </div>
					</div>
					<div class="col-md-2 align-self-center cstmSpaceBtn">
						<button type="button" class="btn btn-primary addToListBtn">Add</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer"> </div>
	</div>
</div>
</div>
</div
@endsection
