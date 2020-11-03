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
            margin: 30px 100px;
            padding: 0;
            font-size: 14px;
            line-height: 100%;
            mso-line-height-rule: exactly;
            color: #434b4d;
            width: 100%;
            font-weight: 400;
        }

        @media only screen and (max-width: 560px) {
            body {
                font-size: 12px !important;
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
            padding: 0.3rem 0.3rem !important;
        }

        th {
            padding: .50rem 0.2rem !important;
        }

        .w-25 {
            width: 25%;
        }

        .w-75 {
            width: 75%;
        }

        .memo td{
            padding-top: 0.7rem !important;
            padding-bottom: 0.7rem !important;
        }

        @media print {
            .table-borderless tr, .table-borderless td, .table-borderless th, .table-borderless {
                border-style: hidden !important;
            }
        }
    </style>
</head>
<body>
<div class="main-content">
    <div class="p-1">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td>
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <td>
                                    <p>BinBytes</p>
                                    <p>409-A, The Spire</p>
                                    <p>150-Ft Ring Road</p>
                                    <p>Rajkot, Gujarat - 360005</p>
                                    <p>info@binbytes.com</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table class="table table-bordered text-center">
                            <tbody>
                            <tr>
                                <td class="w-25 table-dark" style="border-bottom: 1px solid #8a8a8a; padding: 10px 5px !important; text-align: left">
                                    INVOICE NO.
                                </td>
                                <td class="w-75" style="border-bottom: 1px solid #dee2e6; padding: 10px 0 !important;">
                                    {{ $bill->project['invoice_prefix'] ? $bill->project['invoice_prefix'] : 'BB' }}-{{ $bill['id'] }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-25 table-dark" style=" padding: 10px 5px !important; text-align: left ">DATE</td>
                                <td class="w-75" style="padding: 10px 0 !important;">{{ date_format($bill['date'], 'd/m/Y') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="table table-borderless">
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-center text-white">BILL TO</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td >
                                    <p>{{ $bill->client['name'] }}</p>
                                    <p>{{ $bill->project['title'] }}</p>
                                    <p>{{ $bill->client['address'] }}</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
            <tr>
                <th class="text-white">DESCRIPTION</th>
                <th class="w-25 text-white">AMOUNT (USD)</th>
                <th class="w-25 text-white">AMOUNT (INR)</th>
            </tr>
            </thead>
            <tbody class="memo">
                <tr>
                    <td>{{ $bill->project['description'] ? $bill->project['description'] : 'Project' }}</td>
                    <td class="w-25">${{ number_format($bill['amount'] / 72, 2 )}}</td>
                    <td class="w-25"><span style="font-family: DejaVu Sans;">&#x20B9;</span>
                        {{ number_format($bill['amount'], 2) }}
                    </td>
                </tr>
            <tr>
                @php
                    $igst = 0.00
                @endphp
                <td>Export Against LUT (IGST)</td>
                <td></td>
                <td><span style="font-family: DejaVu Sans;">&#x20B9;</span>{{$igst}}</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th class="text-right mr-3">Total Amount</th>
                <th class="w-25">${{ number_format($bill['amount'] / 72, 2 )}}</th>
                <th class="w-25"><span style="font-family: DejaVu Sans;">&#x20B9;</span>
                    {{ number_format(($bill['amount'] + $igst), 2) }}
                </th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
</body>
</html>
