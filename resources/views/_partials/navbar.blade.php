<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a href="{{ URL::to('/') }}" class="nav-link">
                            <i class="bx bx-home-circle mr-2"></i> Home
                        </a>
                    </li>


                </ul>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="topnav-menu-content">
                <ul class="navbar-nav">

                    @auth

                    @if (auth()->user()->hasRole('agent'))
                    <li class="nav-item">
                        <a href="{{ URL::to('lead/create') }}" class="nav-link">
                            <i class='bx bx-plus-circle mr-2'></i> Add Item
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ URL::to('lead') }}" class="nav-link">
                            <i class="bx bx-pyramid mr-2"></i> My Items
                        </a>
                    </li>
                    @elseif (auth()->user()->hasRole('bdm') || auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('developer'))
                    <li class="nav-item">
                        <a href="{{ route('sales-engine.create') }}" class="nav-link">
                            <i class='bx bx-plus-circle mr-2'></i> Add Item
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sales-engine.reports') }}" class="nav-link">
                            <i class='bx bxs-report mr-2'></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ URL::to('admin') }}" class="nav-link">
                            <i class="bx bx-pyramid mr-2"></i> Admin Panel
                        </a>
                    </li>
                    @endif

                    @endauth

                </ul>
            </div>
        </nav>
    </div>
</div>
