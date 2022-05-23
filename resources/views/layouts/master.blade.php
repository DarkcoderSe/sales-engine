<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title> @yield('title') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('/assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        {{-- Custom Css  --}}
        {{-- <link href="{{asset('/assets/css/style.css')}}" id="app-style" rel="stylesheet" type="text/css" /> --}}

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

            $(document).ready(function() {
                $('select').select2();
                $(".bs-select").select2('destroy');
            });
        </script>
    </body>

</html>
