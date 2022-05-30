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
thead{
    background-color: black;
    color: white;
}

</style>
<div class="row justify-content-center">
    <div class="col-10 col-md-10 pb-4 mb-4">

        <form action="{{ route("sales-engine.report-search") }}" method="post" id="search-form">
            @csrf

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Reports Section:</h4>
                    <p class="card-title-desc">Fill all information below</p>
                <div class="row">
                        <div class="col-md-6">
                            <label>Serach</label>
                            <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text"  name="search" id="search-field" class="form-control searchfield" placeholder="Type here....">
                        </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Date From </label>
                        <input type="date" id="filter-date-from" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Date to </label>
                        <input type="date" class="form-control"  id="filter-date-to">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Profile </label>
                        <select  class="form-control" id="filter-profile">
                            <option>Imran Ahmad</option>
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
                        <select  class="form-control" id="filter-phase">
                            <option>None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Status </label>
                        <select  class="form-control" id="filter-status">
                            <option>None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Technology </label>
                        <select  class="form-control" id="filter-technology">
                            <option>None</option>
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
                        <select  class="form-control"  id="filter-bd">
                            <option>None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Job Source </label>
                        <select  class="form-control"  id="filter-job-source">
                            <option>None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Assigned to </label>
                        <select  class="form-control" id="filter-assigned-to">
                            <option>None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <div class="custom-control custom-switch mb-3" dir="ltr">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
                        <label class="custom-control-label" for="customSwitch1">Filter leads based on historical data</label>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <div class="custom-control custom-switch mb-3" dir="ltr">
                        <input type="checkbox" class="custom-control-input" id="customSwitch2" checked="">
                        <label class="custom-control-label" for="customSwitch2">Filter leads based on over due dates</label>
                        </div>
                        </div>
                    </div>
                </div>
        </div>


            </div>


            <div class="text-right mt-4 mb-4">
{{--                <button type="submit" class="btn btn-primary waves-effect waves-light">Filter </button>--}}
                <input type="submit" class="btn btn-primary waves-effect waves-light" id="search-btn" name="add-job-btn" value="Filter">
                <input type="button" onclick="clearFunction()"  class="btn btn-primary waves-effect waves-light" value="Clear">
            </div>
        </form>


    </div>
</div>
{{--Hide section--}}
<div class="row justify-content-center d-none" id="search-result">
    <div class="col-10 col-md-10 pb-4 mb-4">
    <div class="card">
        <div class="card-body">
<table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
    <thead>
    <tr role="row">
        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 95px;" aria-label="Age: activate to sort column ascending">Created At</th>
        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 230px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Company Name</th>
        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 350px;" aria-label="Position: activate to sort column ascending">Job Title</th>
        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 350px;" aria-label="Position: activate to sort column ascending">Job Source</th>
        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 350px;" aria-label="Position: activate to sort column ascending">Assign To</th>
        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 350px;" aria-label="Position: activate to sort column ascending">Profile</th>
        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 168px;" aria-label="Start date: activate to sort column ascending">Status</th>
        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 178px;" aria-label="Office: activate to sort column ascending">Agent (BD) </th>

    </tr>
    </thead>
    <tbody id="search-row">
    <tr role="row" class="odd" id="search-row">

    </tr>

    </tbody>
</table>
        </div></div></div></div>
@endsection
