<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <img class="d-inline-block align-top mr-1" src="{{ asset('images/logo.png') }}" height="25">
                    <span class="d-none d-md-inline ml-1">{{ config('app.name', 'BinBytes') }}</span>
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons"></i>
            </a>
        </nav>
    </div>
    {{--<form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">--}}
        {{--<div class="input-group input-group-seamless ml-3">--}}
            {{--<div class="input-group-prepend">--}}
                {{--<div class="input-group-text">--}}
                    {{--<i class="fas fa-search"></i>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search">--}}
        {{--</div>--}}
    {{--</form>--}}
    <div class="nav-wrapper">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @can('index', App\User::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="/users">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
            @endcan
            @can('index', App\Client::class)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('clients*') ? 'active' : '' }}" href="/clients">
                    <i class="fas fa-users"></i>
                    <span>Clients</span>
                </a>
            </li>
            @endcan
            @can('index', App\Project::class)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('projects*') ? 'active' : '' }}" href="/projects">
                    <i class="fa fa-tasks"></i>
                    <span>Projects</span>
                </a>
            </li>
            @endcan
            @can('index', App\Holiday::class)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('holidays*') ? 'active' : '' }}" href="/holidays">
                    <i class="fa fa-calendar-alt"></i>
                    <span>Holidays</span>
                </a>
            </li>
            @endcan
            @can('index', App\Leave::class)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('leaves*') ? 'active' : '' }}" href="/leaves">
                    <i class="fa fa-calendar-alt"></i>
                    <span>Leaves</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</aside>