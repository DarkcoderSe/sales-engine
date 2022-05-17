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

                    <li class="nav-item">
                        <a href="{{ URL::to('project/all') }}" class="nav-link">
                            <i class='bx bxl-product-hunt mr-2'></i> New Projects
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ URL::to('agency/agents') }}" class="nav-link">
                            <i class='bx bxs-group mr-2'></i> All Agents
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ URL::to('all-cities') }}" class="nav-link">
                            <i class="bx bx-pyramid mr-2"></i> All Cities
                        </a>
                    </li>

                    @auth
                    <li class="nav-item">
                        <a href="{{ URL::to('/property/all') }}" class="nav-link">
                            <i class="bx bx-buildings mr-2"></i> My Properties
                        </a>
                    </li>
                    @endauth
                    <li class="nav-item">
                        <a href="{{ URL::to('/property/add') }}" class="nav-link">
                            <i class="bx bx-plus-circle mr-2"></i> Add Property
                        </a>
                    </li>

                    @guest
                    <li class="nav-item">
                        <a href="{{ URL::to('/register') }}" class="nav-link">
                            <i class="bx bx-store-alt mr-2"></i> Sign up
                        </a>
                    </li>
                    @endguest

                </ul>
            </div>
        </nav>
    </div>
</div>
