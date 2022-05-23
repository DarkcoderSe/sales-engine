@extends('layouts.master')

@section('title', 'Add new Lead')

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
			<button type="submit" class="btn btn-primary waves-effect waves-light">Add Item</button>
		</div>
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">All Items Data</h4>
				<div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="dataTables_length" id="datatable_length">
								<label>Show
									<select name="datatable_length" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm">
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select> entries</label>
							</div>
						</div>
						<div class="col-sm-12 col-md-6 text-right">
							<div id="datatable_filter" class="dataTables_filter cstm-search-data">
								<label style="text-align:left;">Search:
									<input type="search" class="form-control " placeholder="" aria-controls="datatable">
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 table-responsive">
							<table id="datatable" class="table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable_info">
								<thead>
									<tr role="row">
										<th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 230px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Company Name</th>
										<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 350px;" aria-label="Position: activate to sort column ascending">Position Applied</th>
										<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 178px;" aria-label="Office: activate to sort column ascending">Agent (BD) </th>
										<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 95px;" aria-label="Age: activate to sort column ascending">Created At</th>
										<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 168px;" aria-label="Start date: activate to sort column ascending">Status</th>

									</tr>
								</thead>
								<tbody>
									<tr role="row" class="odd">
										<td class="sorting_1 dtr-control">Airi Satou</td>
										<td>Accountant</td>
										<td>Tokyo</td>
                                        <td>2008/11/28</td>
										<td>None</td>
									</tr>
									<tr role="row" class="even">
										<td class="sorting_1 dtr-control">Angelica Ramos</td>
										<td>Chief Executive Officer (CEO)</td>
										<td>London</td>
										<td>2009/10/09</td>
										<td>None</td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1 dtr-control">Ashton Cox</td>
										<td>Junior Technical Author</td>
										<td>San Francisco</td>
                                        <td>2009/01/12</td>
										<td>Ready</td>

									</tr>
									<tr role="row" class="even">
										<td class="sorting_1 dtr-control">Bradley Greer</td>
										<td>Software Engineer</td>
										<td>London</td>
										<td>2012/10/13</td>
										<td>41</td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1 dtr-control">Brenden Wagner</td>
										<td>Software Engineer</td>
										<td>San Francisco</td>
                                        <td>2011/06/07</td>
										<td>28</td>

									</tr>
									<tr role="row" class="even">
										<td class="sorting_1 dtr-control">Brielle Williamson</td>
										<td>Integration Specialist</td>
										<td>New York</td>

										<td>2012/12/02</td>
										<td>61</td>
									</tr>
									<tr role="row" class="odd">
										<td class="sorting_1 dtr-control">Bruno Nash</td>
										<td>Software Engineer</td>
										<td>London</td>

										<td>2011/05/03</td>
										<td>38</td>
									</tr>
									<tr role="row" class="even">
										<td class="sorting_1 dtr-control">Caesar Vance</td>
										<td>Pre-Sales Support</td>
										<td>New York</td>

										<td>2011/12/12</td>
										<td>21</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-7">
							<div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
						</div>
						<div class="col-sm-12 col-md-5">
							<div class="dataTables_paginate paging_simple_numbers text-right" id="datatable_paginate">
								<ul class="pagination cstm-pag">
									<li class="paginate_button page-item previous disabled" id="datatable_previous"><a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
									<li class="paginate_button page-item active"><a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
									<li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
									<li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
									<li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
									<li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
									<li class="paginate_button page-item "><a href="#" aria-controls="datatable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
									<li class="paginate_button page-item next" id="datatable_next"><a href="#" aria-controls="datatable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div @endsection
