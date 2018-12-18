<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BinBytes') }}</title>

    <!-- Styles -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ mix('css/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body class="h-100">
    <div class="container-fluid h-100" id="app">
        <div class="row h-100">
            @auth
                @include('layouts.partials.nav')
            @endauth

            <main class="main-content {{ auth()->guest() ? 'col' : 'col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3' }}">
                @auth
                    @include('layouts.partials.top-nav')
                @endauth

                <div class="main-content-container container-fluid px-4 h-100">
                    @auth
                        <div class="page-header row no-gutters py-4">
                            <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                                <span class="text-uppercase page-subtitle">{{ $subTitle ?? '' }}</span>
                                <h3 class="page-title">{{ $pageTitle ?? '' }}</h3>
                            </div>
                        </div>
                    @endauth

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <!-- App scripts -->
    @stack('scripts')
</body>
</html>
