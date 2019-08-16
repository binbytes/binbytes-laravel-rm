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
{{--  <link rel="dns-prefetch" href="https://fonts.gstatic.com">--}}
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <style>
    @font-face {
      font-family: 'Roboto';
      src: {{ storage_path('fonts/Roboto-Regular.ttf') }} format('truetype');
      font-weight: normal;
      font-style: normal;

    }

    body {
      margin: 0;
      padding: 0;
      font-size: 15px;
      line-height: 160%;
      mso-line-height-rule: exactly;
      color: #434b4d;
      width: 100%;
      font-weight: 400;
    }

    @media only screen and (max-width: 560px) {
      body {
        font-size: 14px !important;
      }
    }

    b, th {
      color: black !important;
      font-weight: 600 !important;
    }

    body, table, td {
      font-family: 'Roboto', sans-serif;
    }

    table {
      width: 100%;
    }

    td {
      padding: 0.3rem 0.2rem !important;
    }

    th {
      padding: .50rem 0.2rem !important;
    }

    .row {
      margin-right: 0 !important;
      margin-left: 0 !important;
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

    .w-20 {
      width: 20%;
    }
    .table-borderless {
      margin: -6px 0 !important;
    }

    .logo {
      width: 0.5%;
      padding-left: 0 !important;
      padding-right: 0 !important;
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
      margin-top: 0;
    }

    .address {
      font-weight: 400 !important;
      line-height: 2px;
      font-size: 0.8em !important;
    }

    .header-title {
      font-weight: 700 !important;
      font-size: 1.3em !important;
    }
  </style>
</head>
<body>
<div class="main-content" align="center">
  <div class="box">
    <table cellspacing="0" cellpadding="0">
      @yield('data')
    </table>
  </div>
</div>
</body>
</html>
