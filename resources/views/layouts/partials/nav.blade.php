<aside class="main-sidebar {{ optional(auth()->user())->use_icon_sidebar ? 'icon-sidebar' : '' }} col-12 col-md-3 col-lg-2 px-0">
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
                    <i class="material-icons">
                        supervised_user_circle
                    </i>
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
                    <i class="material-icons">
                        event
                    </i>
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
            @can('index', App\Designation::class)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('designations*') ? 'active' : '' }}" href="/designations">
                    <i class="fas fa-user"></i>
                    <span>Designations</span>
                </a>
            </li>
            @endcan
            @can('view', App\Salary::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('salary*') ? 'active' : '' }}" href="/salary">
                        <i class="fas fa-sort-amount-down"></i>
                        <span>Salary</span>
                    </a>
                </li>
            @endcan
            @can('index', App\Salary::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('salaries*') ? 'active' : '' }}" href="/salaries">
                        <i class="fas fa-sort-amount-up"></i>
                        <span>Paid Salary</span>
                    </a>
                </li>
            @else
                @can('show', [\App\Salary::class, auth()->user()])
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('salaries*') ? 'active' : '' }}" href="/salaries/{{ auth()->id() }}">
                            <i class="fas fa-sort-amount-up"></i>
                            <span>My Salaries</span>
                        </a>
                    </li>
                @endcan
            @endcan
            @can('index', App\Account::class)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('accounts*') ? 'active' : '' }}" href="/accounts">
                    <i class="material-icons">
                        account_balance_wallet
                    </i>
                    <span>Accounts</span>
                </a>
            </li>
            @endcan
            @can('index', App\TransactionType::class)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('transaction-types*') ? 'active' : '' }}" href="/transaction-types">
                    <i class="material-icons">
                        repeat
                    </i>
                    <span>Transaction Types</span>
                </a>
            </li>
            @endcan
            @can('index', App\Bill::class)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('invoice*') ? 'active' : '' }}" href="/invoice">
                    <i class="material-icons">
                        request_quote
                    </i>
                    <span>Invoice</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</aside>