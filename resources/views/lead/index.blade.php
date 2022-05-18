@extends('layouts.master')

@section('title', 'My Leads')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="">
            <div class="table-responsive">
                <table class="table project-list-table table-nowrap table-centered table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Company Name</th>
                            <th scope="col">Job Title</th>
                            <th scope="col">Contact Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (auth()->user()->leads as $lead)
                        <tr>
                            <td>
                                {{ $lead->company_name }}
                            </td>
                            <td>
                                {{ $lead->job_title }}
                            </td>
                            <td>
                                {{ $lead->contact_name }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <h4>No Recent Leads Found</h4>
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

{{-- <div class="row">
    <div class="col-12">
        <div class="text-center my-3">
            <a href="javascript:void(0);" class="text-success"><i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more </a>
        </div>
    </div>
</div> --}}
<!-- end row -->

@endsection
