<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="telephone=no" name="format-detection" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-size: 15px;
            line-height: 160%;
            mso-line-height-rule: exactly;
            color: #434b4d;
            width: 100%;
            font-weight: 400 !important;
        }

        @media only screen and (max-width: 560px) {
            body {
                font-size: 14px !important;
            }
        }

        b, th {
            color: black;
        }

        body, table, td {
            font-family: Open Sans, Roboto, Helvetica Neue, Helvetica, Arial, sans-serif;
        }

        table {
            width: 100%;
        }

        td, th {
            padding: .50rem !important;
        }

        .wrap {
            width: 100%;
            text-align: left;
        }

        .box {
            background: #ffffff;
            border-radius: 3px;
            -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        }

        .box + .box {
            margin-top: 24px;
        }

        .center {
            text-align: center;
        }

        .table-borderless {
            margin: -6px 0 !important;
        }

        @media print {
            .table-borderless tr, .table-borderless td, .table-borderless th, .table-borderless {
                border-style: hidden !important;
            }
        }

        img {
            vertical-align: top !important;
        }

        hr {
            border-top: 1px solid rgba(17, 17, 17, 0.96);
            margin-bottom: 2rem;
        }

        h6 {
            color: #6c757d !important;
            font-weight: 400 !important;
        }
    </style>
</head>
<body>
    <div class="main-content" align="center">
        <div class="box">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td class="center">
                        <h4><img src="{{ url('images/logo.png') }}" alt="Logo" width="25"> BINBYTES</h4>
                        <h6 class="mt-3">213, Nakshatra 7, Raiya Road, Rajkot-360005, Gujarat, India.</h6>
                        <h6>info@binbytes.com - Website : www.binbytes.com</h6>
                        <h6>Phone : (+91) 75670 72070 / (+91) 90330 90059</h6>
                    </td>
                </tr>
            </table>
            <hr>
            <table class="mt-5">
                @yield('data')
            </table>
        </div>
    </div>
</body>
</html>
