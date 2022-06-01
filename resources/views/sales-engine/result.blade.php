@extends('layouts.master')

@section('title', 'Search Organizations - Sales Engine')

@section('content')
<style>
.cstm-pag{
    justify-content:right !important;
}
.cstm-search-data{
    margin-top:-20px !important;
}
</style>
<div class="row justify-content-center">
	<div class="col-10 col-md-10 pb-4 mb-4">
		<div class="text-right mt-4 mb-4">
            <a href="{{ route('sales-engine.create') }}" class="btn btn-primary waves-effect waves-light">Add Item</a>
		</div>
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">All Items Data</h4>
				<div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
								<thead>
									<tr role="row">
										<th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 230px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Company Name</th>
										<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 350px;" aria-label="Position: activate to sort column ascending">Position Applied</th>
										<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 178px;" aria-label="Office: activate to sort column ascending">Agent (BD) </th>
										<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 178px;" aria-label="Office: activate to sort column ascending">Tech Stack</th>
										<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 95px;" aria-label="Age: activate to sort column ascending">Created At</th>
										<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 168px;" aria-label="Start date: activate to sort column ascending">Status</th>

									</tr>
								</thead>
								<tbody>
                                    @foreach ($bdmLeads as $lead)
									<tr role="row" class="odd">
										<td class="sorting_1 dtr-control">
                                            <a href="{{ route('sales-engine.edit', $lead->id) }}">
                                                {{ $lead->company_name }}
                                            </a>
                                        </td>
										<td>{{ $lead->job_title }}</td>
										<td>{{ $lead->addedBy->name ?? '' }} </td>
                                        <td>
                                            @foreach ($lead->techs as $technology)
                                            <span class="badge badge-pill badge-primary">
                                                {{ $technology->name ?? '' }}
                                            </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $lead->created_at->diffForHumans() }}
                                            <span class="small text-muted">{{ $lead->created_at }}</span>
                                        </td>
										<td>
                                            @if ($lead->status == 0)
                                            Prospect
                                            @elseif ($lead->status == 1)
                                            Warm Lead
                                            @elseif ($lead->status == 2)
                                            Cold Lead
                                            @elseif ($lead->status == 3)
                                            Hired
                                            @elseif ($lead->status == 4)
                                            Rejected
                                            @endif
                                        </td>
									</tr>
                                    @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div
@endsection
