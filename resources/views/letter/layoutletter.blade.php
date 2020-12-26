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
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <style>
      @page {
        margin: 0cm 0cm;
      }
    @font-face {
      font-family: 'Roboto';
      src: {{ storage_path('fonts/Roboto-Regular.ttf') }} format('truetype');
      font-weight: normal;
      font-style: normal;
    }

    body {
      font-family: 'Roboto' sans-serif;
      background: white;
      height: 100%;
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
        font-size: 13px !important;
      }
    }

    header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 200px;
      padding: 10px 50px;
      background-color: #ccc;
      z-index: 1000;
    }

    .text-center {
      text-align: center;
    }

    main {
      padding: 10px 50px;
    }

    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      height: 25px;
      border-bottom: 20px solid rgba(149, 90, 195, 0.96);
      z-index: 1000;
    }

    .details {
      margin-top: 20px;
      padding: 2px 0;
      background: #ffffff;
    }
    
    label {
      font-weight: bold;
      font-size: 15px;
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

    .h-100 {
      height: 100%;
      margin: 0 !important;
    }

    .w-15 {
      width: 15%;
    }

    .w-20 {
      width: 20%;
    }

    .w-30 {
      width: 30%;
    }

    .w-35 {
      width: 35%;
    }

    .table-borderless {
      margin: -6px 0 !important;
    }

    .logo {
      width: 0.6%;
      padding-left: 0 !important;
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
    .title {
      color: black !important;
      font-weight: 500 !important;
    }
    .letter {
      padding: 1rem !important;
    }
    .letter h6 {
      font-size: 1.2em;
      color: black;
      margin-bottom: 0 !important;
    }
    .footer {
      margin-top: 5rem !important;
    }
    .page-break {
      page-break-before: always;
    }
    .page-break:last-child {
      page-break-before: avoid;
    }
  </style>
</head>
<body>
  <main>
    <div class="details">
      <table cellspacing="0" cellpadding="0">
        <tbody>
          @yield('data')
        </tbody>
          @yield('footer')
      </table>
    </div>
  </main>
  <footer>
  </footer>
</body>
</html>
