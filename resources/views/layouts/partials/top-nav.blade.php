<div class="main-navbar sticky-top bg-white">
    <!-- Main Navbar -->
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <div action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex"></div>
        <ul class="navbar-nav border-left flex-row pl-2">
            <li class="nav-item border-right dropdown notifications">
                <notifications :auth-id="{{ auth()->id() }}"></notifications>
            </li>
            <li class="nav-item align-self-center">
                @if(! auth()->user()->attendanceExcluded())
                    <timer :initial-time="{{ auth()->user()->today_attendance->totaltime ?: 0 }}" class="nav-link"></timer>
                @endif
            </li>
            <li class="nav-item dropdown align-self-center">
                <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar_url }}" class="avatar" alt="user-avatar">
                    @endif
                    <span class="d-none d-md-inline-block">{{ auth()->user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item" href="/my-profile">
                        <i class="material-icons"></i> My Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons text-danger"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <nav class="nav">
            <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
                <i class="material-icons"></i>
            </a>
        </nav>
    </nav>
</div>