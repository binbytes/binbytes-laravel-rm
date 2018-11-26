<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial sans-serif;
            background: white;
            color: #777777;
            height: 100%;
            width: 100%;
        }

        table, tr, td, th {
            padding: 6px 5px !important;
            margin: 1px 0 !important;
        }

        .main {
            min-width: 100%;
        }

        .header .logo {
            width: 150px;
            text-align: center;
        }

        .header .header-text {
            width: 400px;
            text-align: center;
        }

        .header h5 {
            margin-bottom: 5px;
        }

        .table-borderless {
            margin: -10px 0 !important;
        }

        .info td {
            width: 50%;
            padding-bottom: 3px;
        }

        td .label {
            width: 30%;
        }

        .center {
            text-align: center;
        }

        .heading, th {
            color: black;
        }

        .title {
            color: #2176bd;
        }

        .letter, .letter h6 {
            font-size: 1.2em;
            color: black;
        }

        .letter td p {
            margin-bottom: 8px;
        }

        .footer .logo {
            width: 100px;
            text-align: center;
        }

        .footer .footer-text {
            width: 1000px;
            text-align: left;
        }

        .footer h5 {
            margin-bottom: 5px;
        }

        @media print {
            .table-borderless tr, .table-borderless td, .table-borderless th, .table-borderless {
                border-style: hidden !important;
            }
        }
    </style>
</head>
<body>
<table>
    <tr class="header">
        <td class="logo">
            <img src="{{ url('images/logo.png') }}" alt="Logo" width="70">
            <h5>BINBYTES</h5>
        </td>
        <td class="header-text">
            <h5 class="title">BINBYTES</h5>
            <h5>213, Nakshatra 7,</h5>
            <h5>Raiya Road,</h5>
            <h5>Rajkot - 360005</h5>
        </td>
    </tr>
</table>
<hr>
<table class="main">
    @yield('data')
</table>
<hr>
<table>
    <tr class="footer">
        <td class="logo">
            <img src="{{ url('images/logo.png') }}" alt="Logo" width="40">
            <h5 class="heading">BinBytes</h5>
        </td>
        <td class="footer-text">
            <h5>Office No - 213, Nakshatra 7, Raiya Road, Rajkot-360005, Gujarat, India.</h5>
            <h5>info@binbytes.com - Website : www.BinBytes.com</h5>
            <h5>Phone : (+91) 75670 72070 / (+91) 90330 90059</h5>
        </td>
    </tr>
</table>
</body>
</html>
