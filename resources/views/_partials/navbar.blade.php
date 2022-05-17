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
                    <li class="nav-item">
                        <a href="{{ URL::to('lead/create') }}" class="nav-link">
                            <i class='bx bx-plus-circle mr-2'></i> Add a Lead
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ URL::to('lead') }}" class="nav-link">
                            <i class="bx bx-pyramid mr-2"></i> My Leads
                        </a>
                    </li>
                    @endauth

                </ul>
            </div>
        </nav>
    </div>
</div>
