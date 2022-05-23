<header id="page-topbar" style="/* background: #1877f2 !important; */">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{URL::to('/')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('td-logo.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('td-logo.png')}}" alt="" height="17">
                    </span>
                </a>

                <a href="{{URL::to('/')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('td-logo.png')}}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('td-logo.png')}}" alt="" height="50">
                    </span>

                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            {{-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Find with Property ID">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form> --}}

        </div>

        <div class="d-flex">

            @auth
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <div class="row">
                        <div class="col pr-0" title="{{ auth()->user()->name ?? '' }}">
                            @if (auth()->user()->picture)
                            <img class="rounded-circle header-profile-user"  src="{{ URL::to(auth()->user()->picture ?? '') }}" onerror="this.src=`{{ URL::to('/assets/images/users/avatar-6.jpg') }}`"
                                alt="Header Avatar">
                            @else
                            <div class="avatar-xs align-self-center mr-3">
                                <span class="avatar-title rounded-circle text-primary" style="background-color: #eee;">
                                    {{ auth()->user()->name[0] }}
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>


                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="route('logout')" class="dropdown-item text-danger"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout
                        </a>
                    </form>
                </div>
            </div>
            @else
            <div class="d-inline-block mr-4">
                <a href="{{URL::to('login')}}" class="btn header-item waves-effect pl-2 pr-2">
                    <i class="bx bx-user bx-md mt-2" title="Login"></i>
                </a>

            </div>
            @endauth



        </div>
    </div>
</header>
