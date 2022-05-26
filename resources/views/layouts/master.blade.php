<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <title> @yield('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    {{-- Custom Css  --}}
    {{-- <link href="{{asset('/assets/css/style.css')}}" id="app-style" rel="stylesheet" type="text/css" /> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    @stack('style')

    <style>
        @media (max-width: 450px) {
            .footer {
                position: relative !important;
            }
        }

        .select2-container .select2-selection--single {
            height: 35px !important;
        }

    </style>
</head>

<body data-topbar="dark" data-layout="horizontal">

<!-- Begin page -->
<div id="layout-wrapper">

@include('_partials.header')

@include('_partials.navbar')


<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            @yield('main-search')

            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="{{URL::to('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{URL::to('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::to('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{URL::to('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{URL::to('assets/libs/node-waves/waves.min.js')}}"></script>

<!-- apexcharts -->
{{-- <script src="{{URL::to('assets/libs/apexcharts/apexcharts.min.js')}}"></script> --}}

{{-- <script src="{{URL::to('assets/js/pages/dashboard.init.js')}}"></script> --}}

<!-- App js -->
<script src="{{URL::to('assets/js/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}

@stack('script')

<script>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error(`{{$error}}`);
    @endforeach
    @endif

    $(document).ready(function () {
        $('select').select2();
        $(".bs-select").select2('destroy');
    });
</script>
<script>
    function getJobSource() {
        let url = '{{ URL::to('sales-engine/get-job-source') }}';
        $.get(url, function (response) {
            $("#job_source_select").empty();
            $("#job_source_select").append('<option>--Select Source Job--</option>');
            response.forEach(row => {
                $("#job_source_select").append('<option value=' + row.id + '>' + row.name + '</option>');
            });
        });
    }


    function getProfile() {
        let url = '{{ URL::to('sales-engine/get-profile') }}';
        $.get(url, function (response) {
            $("#profile_select").empty();
            $("#profile_select").append('<option>--Select Profile--</option>');
            response.forEach(row => {
                $("#profile_select").append('<option value=' + row.id + '>' + row.name + '</option>');
            });
        });
    }

    function getTechnology() {
        let url = '{{ URL::to('sales-engine/get-technology') }}';
        $.get(url, function (response) {
            $("#technology_select").empty();
            response.forEach(row => {
                $("#technology_select").append('<option value=' + row.id + '>' + row.name + '</option>');
            });
        });
    }
</script>
<script>
    $(function () {
        $("#add-job-form").submit(function (event) {

            event.preventDefault(); // Prevent the form from submitting via the browser
            var form = $(this);
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize()
            }).done(function (data) {
                $('#addJobSource').modal('hide');
                getJobSource();
                toastr.success('Item added successfully');

                // Optionally alert the user of success here...
            }).fail(function (data) {
                // Optionally alert the user of an error here...
            });
        });

        $("#add-profile-form").submit(function (event) {

            event.preventDefault(); // Prevent the form from submitting via the browser
            var form = $(this);
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize()
            }).done(function (data) {
                $('#addProfile').modal('hide');
                getProfile();
                toastr.success('Item added successfully');


                // Optionally alert the user of success here...
            }).fail(function (data) {
                // Optionally alert the user of an error here...
            });
        });

        $("#add-technology-form").submit(function (event) {

            event.preventDefault(); // Prevent the form from submitting via the browser
            var form = $(this);
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize()
            }).done(function (data) {
                $('#addTechnology').modal('hide');
                getTechnology();
                toastr.success('Item added successfully');

                // Optionally alert the user of success here...
            }).fail(function (data) {
                // Optionally alert the user of an error here...
            });
        });
    });
</script>
<script>
    function clearFunction(){
        $('#search-form').trigger("reset");
    }


    $('#search-form').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: {
                "_token": "{{ csrf_token() }}",
                "search": $('#search').val()
            }
        }).done(function (data) {
            let rowDoms = '';

            if (data == null) {
                alert('im he');
                rowDoms += `<tr>
                                        <td colspan="5">No data Found</td>

                                 </tr>`;
                $('#search-result').removeClass('d-none');


            } else {
                data.forEach(row => {
                    rowDoms += `<tr>
                                        <td>${row.created_at}</td>
                                        <td>${row.company_name}</td>
                                        <td>${row.job_title}</td>
                                        <td>${row.job_source.name}</td>
                                        <td>${row.developer.name}</td>
                                        <td>${row.profile.name}</td>
                                        <td>${row.status}</td>
                                        <td>${row.agent.name}</td>
                                 </tr>`;
                });

                $("#search-row").html(rowDoms);
                // $('#company_name').val(data.company_name);
                // console.log(data);
                $('#search-result').removeClass('d-none');

            }
            // Optionally alert the user of success here...
        }).fail(function (data) {
            // Optionally alert the user of an error here...
        });
    });
    {{--      search();--}}
    {{--      function search(){--}}
    {{--          var keyword = $('#search').val();--}}
    {{--          alert(keyword);--}}
    {{--          --}}
    {{--          $.post('{{ route("sales-engine.report-search") }}',--}}
    {{--              {--}}
    {{--                  keyword:keyword--}}
    {{--              },--}}
    {{--              function(data){--}}
    {{--                  table_post_row(data);--}}
    {{--                  console.log(data);--}}
    {{--              });--}}
    {{--      }--}}
    {{--      // table row with ajax--}}
    {{--      function table_post_row(res){--}}
    {{--          let htmlView = '';--}}
    {{--          if(res.employees.length <= 0){--}}
    {{--              htmlView+= `--}}
    {{-- <tr>--}}
    {{--    <td colspan="4">No data.</td>--}}
    {{--</tr>`;--}}
    {{--          }--}}
    {{--          for(let i = 0; i < res.employees.length; i++){--}}
    {{--              htmlView += `--}}
    {{--  <tr>--}}
    {{--     <td>`+ (i+1) +`</td>--}}
    {{--        <td>`+res.employees[i].name+`</td>--}}
    {{--         <td>`+res.employees[i].phone+`</td>--}}
    {{--  </tr>`;--}}
    {{--          }--}}
    {{--          $('tbody').html(htmlView);--}}
    {{--      }--}}
</script>
</body>

</html>
