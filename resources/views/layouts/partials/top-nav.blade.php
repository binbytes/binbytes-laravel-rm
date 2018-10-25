<div class="main-navbar sticky-top bg-white">
    <!-- Main Navbar -->
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <div action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex"></div>
        <ul class="navbar-nav border-left flex-row pl-2">
            <li class="nav-item border-right dropdown notifications">
                <a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="nav-link-icon__wrapper">
                        <i class="material-icons"></i>
                        <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->count() }}</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
                    @forelse(auth()->user()->getRecentNotifications() as $notification)
                        @include('notification')
                    @empty
                        <a class="dropdown-item text-center" href="#"> No Notifications </a>
                    @endforelse
                    <a class="dropdown-item notification__all text-center" href="#"> View all Notifications </a>
                </div>
            </li>
            <li class="nav-item align-self-center">
                <timer :initial-time="{{ auth()->user()->today_attendance->totaltime }}" class="nav-link"></timer>
            </li>
            <li class="nav-item dropdown align-self-center">
                <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar_url }}" alt="user-avatar">
                    @endif
                    <span class="d-none d-md-inline-block">{{ auth()->user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-small">
                    {{--<a class="dropdown-item" href="/profile">--}}
                        {{--<i class="material-icons"></i> Profile--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
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