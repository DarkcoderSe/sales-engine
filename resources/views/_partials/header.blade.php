<header id="page-topbar" style="background: #1877f2 !important;">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{URL::to('/')}}" class="logo logo-dark">
                    {{-- <span class="logo-sm">
                        <img src="assets/images/logo.svg" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="17">
                    </span> --}}
                    <h2 class="text-white">LOGO</h2>
                </a>

                <a href="{{URL::to('/')}}" class="logo logo-light">
                    {{-- <span class="logo-sm">
                        <img src="assets/images/logo-light.svg" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="19">
                    </span> --}}
                    <h2 class="text-white mt-3 pt-1">LOGO</h2>

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

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="bx bx-bell bx-tada"></i>
                    <span class="badge badge-danger badge-pill" style="margin-left: -5px;">
                        {{ isset($chats) ? count($chats->where('is_read', 0) ?? []) : 0 }}
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-274px, 70px, 0px);">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Messages </h6>
                            </div>
                            <div class="col-auto">
                                <a href="{{ URL::to('messages') }}" class="small"> View All</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar="init" style="max-height: 230px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -15px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                    @isset($chats)
                        @forelse ($chats as $chat)
                        <a href="{{ URL::to("messages?thread={$chat->tid}") }}" style="{{ (!$chat->is_read) ? 'background-color: #eee !important;' : '' }}"; class="text-reset notification-item">
                            <div class="media">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">
                                        {{ $chat->name }}
                                        @if (!$chat->is_read)
                                        <span class="badge badge-danger" style="float: right;">New</span>
                                        @endif
                                    </h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">{{ $chat->message }}</p>
                                        <p class="mb-0">
                                            <i class="mdi mdi-clock-outline"></i> {{ $chat->created_at->diffForHumans() ?? '--:--' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">No Messages Found!</h6>
                                </div>
                            </div>
                        </a>
                        @endforelse
                    @endisset

                    </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 388px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: block; height: 136px;"></div></div></div>
                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="{{ URL::to('messages') }}">
                            <i class="mdi mdi-arrow-right-circle mr-1"></i> View More..
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block d-lg-none ml-2">
                {{-- <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button> --}}
                {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Find with Property ID">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> --}}
            </div>



            @auth
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <div class="row">
                        <div class="col pr-0">
                            @if (auth()->user()->picture)
                            <img class="rounded-circle header-profile-user" src="{{ URL::to(auth()->user()->picture ?? '') }}" onerror="this.src=`{{ URL::to('/assets/images/users/avatar-6.jpg') }}`"
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
                    <a class="dropdown-item" href="{{ URL::to('profile') }}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>

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
