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
                <a class="nav-link " href="/clients">
                    <i class="material-icons">vertical_split</i>
                    <span>Clients</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/users">
                    <i class="material-icons">vertical_split</i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/projects">
                    <i class="material-icons">vertical_split</i>
                    <span>Projects</span>
                </a>
            </li>
        </ul>
    </div>
</aside>