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
.addToListField {
	border-radius: 0px !important;
}

.addToListBtn {
	border-radius: 0px !important;
	/* margin-top:2px; */
}

.cstmSpaceBtn {
	margin-top: 12px;
}
.searchWraper{
    margin:auto;
    width:90%;
    padding-left:120px;
}
</style>
<div class="row justify-content-center">
    <div class="col-12 col-md-12 pb-4 mb-4">

            <div class="card">
                <div class="card-body searchWraper">
                    <div class="row no-gutters">
					<div class="col-md-10 align-self-center">
						<div class="form-group">
							<label>Company Name / Job Title: </label>
							<input type="text" class="form-control addToListField"> </div>
					</div>
					<div class="col-md-2 align-self-center cstmSpaceBtn">
						<button type="button" class="btn btn-primary addToListBtn">Search</button>
					</div>
				</div>

                </div>
        </div>
            </div>


    </div>
</div

@endsection
