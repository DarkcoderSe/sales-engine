@extends('layouts.master')

@section('title', 'Filter Leads')

@push('style')
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
    .w-200 {
        width: 200px !important;
    }

</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-10 col-md-10 pb-4 mb-4">
        <form action="{{ route("sales-engine.reports") }}" method="get">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Reports Section:</h4>
                    <p class="card-title-desc">Fill all information below</p>
                    <div class="row">
                        <div class="col-md-8">
                            <label>Serach</label>
                            <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="text"  name="query" value="{{ request()->get('query') }}" class="form-control searchfield" placeholder="Type here....">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Date From </label>
                            <input type="date" name="from" value="{{ request()->get('from') }}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Date to </label>
                            <input type="date" name="to" value="{{ request()->get('to') }}" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Profile </label>
                            <select name="profile" class="form-control">
                                <option value="-1">Any</option>
                                @foreach ($profiles as $profile)
                                <option value="{{ $profile->id }}" {{ request()->get('profile') == $profile->id ? 'selected' : '' }}>
                                    {{ $profile->name }}
                                </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Phase </label>
                            <select name="phase" class="form-control">
                                <option value="-1" {{ request()->get('phase') == '-1' ? 'selected' : '' }}>Any</option>
                                <option value="0" {{ request()->get('phase') == '0' ? 'selected' : '' }}>Prospect</option>
                                <option value="1" {{ request()->get('phase') == '1' ? 'selected' : '' }}>Initial Correspondence</option>
                                <option value="2" {{ request()->get('phase') == '2' ? 'selected' : '' }}>Follow-up</option>
                                <option value="3" {{ request()->get('phase') == '3' ? 'selected' : '' }}>Pre-call Test</option>
                                <option value="4" {{ request()->get('phase') == '4' ? 'selected' : '' }}>Post-call Test</option>
                                <option value="5" {{ request()->get('phase') == '5' ? 'selected' : '' }}>1st Interview</option>
                                <option value="6" {{ request()->get('phase') == '6' ? 'selected' : '' }}>2nd Interview</option>
                                <option value="7" {{ request()->get('phase') == '7' ? 'selected' : '' }}>3rd Interview</option>
                                <option value="8" {{ request()->get('phase') == '8' ? 'selected' : '' }}>4th Interview</option>
                                <option value="9" {{ request()->get('phase') == '9' ? 'selected' : '' }}>Final Interview</option>
                                <option value="10" {{ request()->get('phase') == '10' ? 'selected' : '' }}>Reference Check</option>
                                <option value="11" {{ request()->get('phase') == '11' ? 'selected' : '' }}>Contract Awaited</option>
                                <option value="12" {{ request()->get('phase') == '12' ? 'selected' : '' }}>Contract Recieved</option>
                                <option value="13" {{ request()->get('phase') == '13' ? 'selected' : '' }}>Contract Signed & Sent</option>
                                <option value="14" {{ request()->get('phase') == '14' ? 'selected' : '' }}>Hired</option>
                                <option value="15" {{ request()->get('phase') == '15' ? 'selected' : '' }}>Rejected</option>
                                <option value="16" {{ request()->get('phase') == '16' ? 'selected' : '' }}>Dormant</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Status </label>
                            <select name="status" class="form-control">
                                <option value="-1" {{ request()->get('status') == '-1' ? 'selected' : '' }}>Any</option>
                                <option value="0" {{ request()->get('status') == '0' ? 'selected' : '' }}>Prospect</option>
                                <option value="1" {{ request()->get('status') == '1' ? 'selected' : '' }}>Warm Head</option>
                                <option value="2" {{ request()->get('status') == '2' ? 'selected' : '' }}>Cold Head</option>
                                <option value="3" {{ request()->get('status') == '3' ? 'selected' : '' }}>Hired</option>
                                <option value="4" {{ request()->get('status') == '4' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Technology </label>
                            <select name="technology" class="form-control">
                                <option value="-1">Any</option>
                                @foreach ($technologies as $technology)
                                <option value="{{ $technology->id }}" {{ request()->get('technology') == $technology->id ? 'selected' : '' }}>
                                    {{ $technology->name }}
                                </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>BD </label>
                            <select name="bdm" class="form-control">
                                <option value="-1">Any</option>
                                @foreach ($bdms as $bdm)
                                <option value="{{ $bdm->id }}" {{ request()->get('bdm') == $bdm->id ? 'selected' : '' }}>
                                    {{ $bdm->name }}
                                </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Job Source </label>
                            <select name="job_source" class="form-control">
                                <option value="-1">Any</option>
                                @foreach ($jobSources as $jobSource)
                                <option value="{{ $jobSource->id }}" {{ request()->get('job_source') == $jobSource->id ? 'selected' : '' }}>
                                    {{ $jobSource->name }}
                                </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Assigned to </label>
                            <select name="developer" class="form-control">
                                <option value="-1">Any</option>
                                @foreach ($developers as $developer)
                                <option value="{{ $developer->id }}" {{ request()->get('developer') == $developer->id ? 'selected' : '' }}>
                                    {{ $developer->name }}
                                </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="custom-control custom-switch mb-3" dir="ltr">
                                    <input type="checkbox" name="historical_data" class="custom-control-input" id="customSwitch1" >
                                    <label class="custom-control-label" for="customSwitch1">Filter leads based on historical data</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="custom-control custom-switch mb-3" dir="ltr">
                                    <input type="checkbox" name="due_dates" class="custom-control-input" id="customSwitch2" >
                                    <label class="custom-control-label" for="customSwitch2">Filter leads based on over due dates</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right mt-4 mb-4">
                <input type="reset" class="btn btn-warning waves-effect waves-light" title="It will clear all the filters" value="Clear">
                <button type="submit" class="btn btn-primary waves-effect waves-light w-200">
                    <i class='bx bx-filter-alt' ></i> &nbsp; Filter
                </button>
            </div>
        </form>
    </div>
</div>

@isset($leads)

@if (count($leads) > 0)

<div class="row justify-content-center">
    <div class="col-md-5">
        <h3>Total Filtered Records: {{ count($leads) }} </h3>
    </div>
    <div class="col-md-5 text-right">
        <h3>Total Records Added Today (So far): {{ count(\App\Models\BdmLead::today()) }} </h3>
    </div>
</div>
<div class="row justify-content-center">
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
                        @foreach ($leads as $lead)
                        <tr role="row">
                            <td>
                                {{ $lead->created_at->diffForHumans() }} <br>
                                <span class="small text-muted">
                                    {{ $lead->created_at }}
                                </span>
                            </td>
                            <td>{{ $lead->company_name }}</td>
                            <td>{{ $lead->job_title }} </td>
                            <td>{{ $lead->jobSource->name ?? '' }} </td>
                            <td>{{ $lead->developer->developer->name ?? '' }} </td>
                            <td>{{ $lead->profile->name ?? '' }} </td>
                            <td>
                                @if ($lead->status == 0)
                                Prospect
                                @elseif ($lead->status == 1)
                                Warm Head
                                @elseif ($lead->status == 2)
                                Cold Head
                                @elseif ($lead->status == 3)
                                Hired
                                @elseif ($lead->status == 4)
                                Rejected
                                @endif
                            </td>
                            <td>{{ $lead->bdm->name ??'' }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $leads->links() }}
            </div>
        </div>
    </div>
</div>
@endif

@endisset

@endsection
